<?php

namespace App\Http\Controllers;

use App\Jobs\ImportOldProduct;
use App\Jobs\ImportProduct;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    public function home()
    {
        $data['sliders'] = Banner::active()
            ->where('location', 'slider')
            ->with('media')
            ->get();

        $data['featuredProducts'] = Product::featured()->with('media')->take(8)->get();
        $data['latestProducts'] = Product::latest()->with('media')->take(8)->get();
        $data['bestSellingProducts'] = Product::active()->with('media')->take(8)->get();

        $data['topCategories'] = Category::withCount('products')
            ->with('media')
            ->latest('products_count')
            ->take(8)
            ->get();

        $data['brands'] = Brand::withCount('products')
            ->with('media')
            ->latest('products_count')
            ->take(12)
            ->get();

        return view('front.home', $data);
    }

    // Import From csv
    public function import()
    {
        ImportOldProduct::dispatch()
            ->onQueue('import-product');

        return redirect()->route('home')
            ->with('success', 'Product Import Started Successfully!');
    }
}
