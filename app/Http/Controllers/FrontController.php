<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class FrontController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::featured()->take(8)->get();
        $latestProducts = Product::latest()->take(8)->get();
        $bestSellingProducts = Product::active()->take(8)->get();

        $topCategories = Category::withCount('products')
            ->latest()
            ->take(8)
            ->get();

        return view('front.home', compact('featuredProducts', 'latestProducts', 'bestSellingProducts', 'topCategories'));
    }

    public function products()
    {
        $products = Product::active()
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.list', compact('products'));
    }

    public function productSingle(Product $product)
    {
        return view('products.single', compact('product'));
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

    public function cart(): View
    {
        $cart = cart();

        return view('front.cart', compact('cart'));
    }

    public function removeFromCart($product_id): RedirectResponse
    {
        cart()->items()->where('product_id', $product_id)->delete();

        return redirect()->back()
            ->with('success', 'Product removed from Wishlist!!!');
    }
}
