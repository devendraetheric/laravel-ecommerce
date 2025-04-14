<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

        return view('front.products', compact('products'));
    }

    public function productSingle(Product $product)
    {
        return view('front.single-product', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] =  [
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Product added to cart successfully');
    }
}
