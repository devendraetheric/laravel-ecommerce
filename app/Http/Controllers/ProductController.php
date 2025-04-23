<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Products']
            ],
            'title' => 'Products',
        ];

        $products = Product::active()
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'breadcrumbs'));
    }

    public function byCategory(Category $category)
    {
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('products.index'), 'text' => 'Products'],
                ['url' => '#', 'text' => $category->name]
            ],
            'title' => $category->name,
        ];

        $products = Product::active()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'breadcrumbs'));
    }

    public function byBrand(Brand $brand)
    {
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('products.index'), 'text' => 'Products'],
                ['url' => '#', 'text' => $brand->name]
            ],
            'title' => $brand->name,
        ];

        $products = Product::active()
            ->where('brand_id', $brand->id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'breadcrumbs'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
