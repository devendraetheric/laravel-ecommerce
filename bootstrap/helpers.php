<?php

use App\Models\Cart;

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
