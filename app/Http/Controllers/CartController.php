<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = cart();

        return view('front.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cart = cart();

        $product = $cart?->items()
            ->where('product_id', $request->product_id)
            ->first();

        if ($product) {
            $product->increment('quantity', $request->quantity);
        } else {
            $cart?->items()
                ->create(
                    [
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                    ]
                );
        }

        return redirect()->back()
            ->with('success', 'Product added to cart successfully!!!');
    }

    public function removeFromCart($product_id): RedirectResponse
    {
        cart()->items()->where('product_id', $product_id)->delete();

        return redirect()->back()
            ->with('success', 'Product removed from Wishlist!!!');
    }
}
