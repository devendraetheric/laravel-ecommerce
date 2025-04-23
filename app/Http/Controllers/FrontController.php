<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

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

        $brands = Brand::withCount('products')
            ->latest()
            ->take(12)
            ->get();

        return view('front.home', compact('featuredProducts', 'latestProducts', 'bestSellingProducts', 'topCategories', 'brands'));
    }
}
