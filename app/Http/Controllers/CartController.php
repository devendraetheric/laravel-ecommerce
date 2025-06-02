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

        $cartItem = $cart?->items()
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            $cartItem = $cart?->items()
                ->create(
                    [
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                    ]
                );
        }

        $itemTotal = $cartItem->product->selling_price * $cartItem->quantity;

        applyTaxesToObject($cartItem, $itemTotal);

        return redirect()->back()
            ->with('success', 'Product added to cart successfully!!!');
    }

    public function removeFromCart($product_id): RedirectResponse
    {
        $cartItem = cart()->items()->where('product_id', $product_id)
            ->first();

        $cartItem->taxes()->delete();

        $cartItem->delete();

        return redirect()->back()
            ->with('success', 'Product removed from Wishlist!!!');
    }

    public function updateCart(Request $request): RedirectResponse
    {
        $cart = cart();

        foreach ($request->quantity as $product_id => $quantity) {
            $cartItem = $cart?->items()
                ->where('product_id', $product_id)
                ->first();

            $cartItem->quantity = $quantity;
            $cartItem->save();

            $itemTotal = $cartItem->product->selling_price * $cartItem->quantity;

            applyTaxesToObject($cartItem, $itemTotal);
        }

        return redirect()->back()
            ->with('success', 'Cart updated successfully!!!');
    }
}
