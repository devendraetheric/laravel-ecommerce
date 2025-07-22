<?php

use App\Enums\TaxType;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\State;
use App\Models\Tax;
use App\Models\Taxable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

if (!function_exists('cart')) {
    function cart(): Cart
    {
        // Session ID
        // dd(session()->getId());
        static $cart = null;

        if ($cart === null) {
            if (Auth::check()) {
                $cart = Cart::FirstOrCreate(['user_id' => Auth::id()]);
            } else {
                $cart = Cart::FirstOrCreate(['session_id' => session()->getId()]);
            }
        }

        return $cart;
    }
}

if (!function_exists('cartCount')) {
    function cartCount(): int
    {
        return cart()->items->count();
    }
}

function setting(string $classOrKey)
{
    // If full class name is passed
    if (class_exists($classOrKey)) {
        return app($classOrKey);
    }

    // If dot notation is passed, e.g., "general.site_name"
    if (str_contains($classOrKey, '.')) {
        [$section, $key] = explode('.', $classOrKey, 2);

        // Map section to class (adjust these according to your setup)
        $map = [
            'general'           => \App\Settings\GeneralSetting::class,
            'prefix'            => \App\Settings\PrefixSetting::class,
            'company'           => \App\Settings\CompanySetting::class,
            'social'            => \App\Settings\SocialMediaSetting::class,
            'payment_paypal'    => \App\Settings\PaypalSetting::class,
            'payment_phonepe'   => \App\Settings\PhonePeSetting::class,
            'payment_razorpay'  => \App\Settings\RazorpaySetting::class,
        ];

        $class = $map[$section] ?? null;

        if (! $class) {
            throw new \Exception("Unknown settings section [$section]");
        }

        return app($class)->$key;
    }

    throw new \Exception("Invalid setting call: [$classOrKey]");
}

if (! function_exists('getLogoURL')) {
    function getLogoURL(): string
    {
        return setting('general.logo') ? asset('storage/' . setting('general.logo')) : asset('assets/logo.png');
    }
}

if (! function_exists('getFaviconURL')) {
    function getFaviconURL(): string
    {
        return setting('general.favicon') ? asset('storage/' . setting('general.favicon')) : asset('assets/favicon.png');
    }
}

if (! function_exists('placeholderURL')) {
    function placeholderURL(): string
    {
        return asset('assets/images/placeholder.png');
    }
}

if (! function_exists('app_country')) {
    function app_country(): Country
    {
        static $country = null;

        return $country ??= Country::find(setting('company.country'));
    }
}

if (! function_exists('app_state')) {
    function app_state(): State
    {
        static $state = null;

        return $state ??= State::find(setting('company.state'));
    }
}

if (! function_exists('get_currency_symbol')) {
    function get_currency_symbol(): string
    {
        static $symbol = null;

        return $symbol ??= app_country()->currency_symbol;
    }
}

if (!function_exists('paymentGateways')) {
    function paymentGateways()
    {
        $settingClasses = [
            \App\Settings\PaypalSetting::class,
            \App\Settings\PhonePeSetting::class,
            \App\Settings\RazorpaySetting::class,
        ];

        return collect($settingClasses)
            ->filter(function ($class) {
                $instance = app($class);
                return $instance->is_active ?? false; // if `is_active` is a property
            })
            ->mapWithKeys(function ($class) {
                $instance = app($class);
                return [$class::group() => $instance->toArray()];
            });
    }
}

if (!function_exists('getDeliveryCharge')) {
    function getDeliveryCharge(): float
    {
        $charge = setting('general.delivery_charge');
        return is_numeric($charge) ? (float)$charge : 0.0;
    }
}

if (!function_exists('applyTaxesToObject')) {
    function applyTaxesToObject(object $item, float $baseAmount, $customerState = null, $sellerState = null)
    {
        $sellerState = app_state()?->id;

        if (!isset($customerState))
            if (Auth::check()) {
                $customerState = Auth::user()?->defaultAddress?->state;
            }

        /* $isInterState = $sellerState !== $customerState;

         if ($isInterState) {
            $taxComponents = Tax::where('type', TaxType::IGST)->get();
        } else {
            $taxComponents = Tax::whereIn('type', [TaxType::CGST, TaxType::SGST])->get();
        } */

        $taxRate = config('usa_tax')[$customerState?->iso2] ?? 0.0;
        $item->taxes()->delete(); // Clear existing taxes for the item

        // return if no tax rate is found
        if (!$taxRate) {
            return;
        }

        $tax = Tax::where('rate', $taxRate)
            ->where('type', TaxType::VAT)
            ->first();

        if (!$tax) {
            $tax = Tax::create(
                [
                    'name' => "VAT " . $taxRate . "%",
                    'type' => TaxType::VAT,
                    'rate' => $taxRate,
                ]
            );
        }

        // foreach ($taxComponents as $tax) {
        $taxAmount = $baseAmount * ($taxRate / 100);

        $item->taxes()->updateOrCreate(
            [
                'taxable_type' => get_class($item),
                'taxable_id'   => $item->id,
                'tax_id' => $tax->id,
            ],
            [
                'tax_rate' => $taxRate,
                'base_amount' => round($baseAmount, 2),
                'tax_amount' => round($taxAmount, 2),
            ]
        );
        // }
    }
}

if (!function_exists('getTaxes')) {
    function getTaxes($customerStateId = null, $sellerStateId = null): array
    {
        $sellerStateId = $sellerStateId ?? app_state()?->id;
        $isInterState = $sellerStateId != $customerStateId;

        if ($isInterState) {
            return Tax::where('type', TaxType::IGST)
                ->where('rate', 18)
                ->get(['id', 'name', 'type', 'rate'])
                ->toArray();
        } else {
            return Tax::whereIn('type', [TaxType::CGST, TaxType::SGST])
                ->where('rate', 9)
                ->get(['id', 'name', 'type', 'rate'])
                ->toArray();
        }
    }
}

if (!function_exists('calculateTaxAmount')) {
    function calculateTaxAmount(float $baseAmount, $customerStateId = null, $sellerStateId = null): float
    {
        $taxes = getTaxes($customerStateId, $sellerStateId);
        $totalTax = 0;

        foreach ($taxes as $tax) {
            $totalTax += $baseAmount * ($tax['rate'] / 100);
        }

        return round($totalTax, 2);
    }
}

if (!function_exists('getTaxBreakdown')) {
    function getTaxBreakdown(float $baseAmount, $customerStateId = null, $sellerStateId = null): array
    {
        $taxes = getTaxes($customerStateId, $sellerStateId);
        $breakdown = [];

        foreach ($taxes as $tax) {
            $taxAmount = $baseAmount * ($tax['rate'] / 100);
            $breakdown[] = [
                'type' => $tax['type'],
                'rate' => $tax['rate'],
                'amount' => round($taxAmount, 2)
            ];
        }

        return $breakdown;
    }
}

if (!function_exists('lucide_icon')) {
    function lucide_icon(string $name, bool $active = false, string $size = 'size-6'): string
    {
        $color = $active ? 'text-primary-600' : 'text-gray-400';

        return sprintf(
            '<i data-lucide="%s" class="%s shrink-0 %s group-hover:text-primary-600"></i>',
            $name,
            $size,
            $color
        );
    }
}

if (!function_exists('generateOrderAccessToken')) {
    /**
     * Generate a unique access token for an order.
     */
    function generateOrderAccessToken($orderNumber)
    {
        $token = Str::random(10);

        // Store order number in cache with token key for 30 minutes
        Cache::put("order_link_token:{$token}", $orderNumber, now()->addMinutes(30));

        return $token;
    }
}
