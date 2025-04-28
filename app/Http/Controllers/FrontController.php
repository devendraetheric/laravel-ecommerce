<?php

namespace App\Http\Controllers;

use App\Jobs\ImportProduct;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function home()
    {
        $data['banners'] = Banner::active()->latest()->get();

        $data['featuredProducts'] = Product::featured()->take(8)->get();
        $data['latestProducts'] = Product::latest()->take(8)->get();
        $data['bestSellingProducts'] = Product::active()->take(8)->get();

        $data['topCategories'] = Category::withCount('products')
            ->latest()
            ->take(8)
            ->get();

        $data['brands'] = Brand::withCount('products')
            ->latest()
            ->take(12)
            ->get();

        return view('front.home', $data);
    }

    // Import From csv
    public function import()
    {
        dispatch(new ImportProduct());

        return redirect()->route('home')
            ->with('success', 'Product Import Started Successfully!');
    }
}
