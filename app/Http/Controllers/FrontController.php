<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

        if (!empty($cart)) {
            // Filter the cart to check if the product already exists
            $filtered = collect($cart)->filter(function ($item) use ($request) {
                return $item['product_id'] == $request->product_id;
            });

            // If the product exists, update its quantity
            if ($filtered->count() > 0) {
                // Find the index of the existing product
                $index = array_search($filtered->first(), $cart);

                // Update the quantity
                $cart[$index]['quantity'] += $request->quantity;
            } else {
                // If the product does not exist, add it to the cart
                $cart = Arr::prepend($cart, [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
            }
        } else {
            // If the cart is empty, add the product directly
            $cart = Arr::prepend($cart, [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Product added to cart successfully');
    }
}
