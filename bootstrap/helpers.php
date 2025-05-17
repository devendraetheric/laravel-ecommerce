<?php

use App\Models\Cart;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

if (!function_exists('cart')) {
    function cart(): Cart
    {
        // Session ID
        // dd(session()->getId());
        static $cart = null;

        if ($cart === null) {
            if (Auth::check()) {
                $cart = Cart::FirstOrCreate(['user_id' => auth()->id()]);
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
            'general'   => \App\Settings\GeneralSetting::class,
            'prefix'    => \App\Settings\PrefixSetting::class,
            'company'   => \App\Settings\CompanySetting::class,
            'social'    => \App\Settings\SocialMediaSetting::class,
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

if (! function_exists('get_currency_symbol')) {
    function get_currency_symbol(): string
    {
        static $symbol = null;

        return $symbol ??= app_country()->currency_symbol;
    }
}
