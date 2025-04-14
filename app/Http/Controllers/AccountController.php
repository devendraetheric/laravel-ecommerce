<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('account.index');
    }

    public function wishlist(): View
    {
        return view('account.wishlist');
    }

    public function addToWishlist($product_id): RedirectResponse
    {
        auth()->user()->wishlists()->attach($product_id);

        return redirect()->back()
            ->with('success', 'Product Added to Wishlist!!!');
    }

    public function removeFromWishlist($product_id): RedirectResponse
    {
        auth()->user()->wishlists()->detach($product_id);

        return redirect()->back()
            ->with('success', 'Product removed from Wishlist!!!');
    }
}
