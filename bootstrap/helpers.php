<?php

use App\Models\Cart;
use App\Settings\GeneralSetting;

if (!function_exists('cart')) {
    function cart(): Cart
    {
        // Session ID
        // dd(session()->getId());

        if (auth()->check()) {
            $cart = Cart::FirstOrCreate(['user_id' => auth()->id()]);
        } else {
            $cart = Cart::FirstOrCreate(['session_id' => session()->getId()]);
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


if (! function_exists('getGeneralSettings')) {
    function getGeneralSettings(): GeneralSetting
    {
        static $settings;

        if (! $settings) {
            $settings = app(GeneralSetting::class);
        }

        return $settings;
    }
}

if (! function_exists('websiteLogo')) {
    function websiteLogo(): string
    {
        return asset('storage/' . getGeneralSettings()->logo);
    }
}

if (! function_exists('websiteFavicon')) {
    function websiteFavicon(): string
    {
        return asset('storage/' . getGeneralSettings()->favicon);
    }
}

if (! function_exists('dateFormat')) {
    function dateFormat(): string
    {
        return getGeneralSettings()->date_format ?? 'd-m-Y';
    }
}
