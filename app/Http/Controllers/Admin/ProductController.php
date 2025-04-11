<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()
            ->with(['brand', 'category'])
            ->paginate()
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();

        $brands = Brand::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.products.form', compact('product', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', 'unique:products,slug'],
            'short_description' => ['nullable', 'string'],
            'long_description'  => ['nullable', 'string'],
            'regular_price'     => ['required', 'numeric', 'min:0'],
            'selling_price'     => ['required', 'numeric', 'min:0'],
            'is_active'         => ['boolean', 'default:0'],
            'is_featured'       => ['boolean', 'default:0'],
            'category_id'       => ['required', 'exists:categories,id'],
            'brand_id'          => ['required', 'exists:brands,id'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $product = Product::create($validated);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $product->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection('featured-image');
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.products.form', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', 'unique:products,slug,' . $product->id],
            'short_description' => ['nullable', 'string'],
            'long_description'  => ['nullable', 'string'],
            'regular_price'     => ['required', 'numeric', 'min:0'],
            'selling_price'     => ['required', 'numeric', 'min:0'],
            'is_active'         => ['boolean', 'default:0'],
            'is_featured'       => ['boolean', 'default:0'],
            'category_id'       => ['required', 'exists:categories,id'],
            'brand_id'          => ['required', 'exists:brands,id'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $product->fill($validated);
        $product->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $product->clearMediaCollection('featured-image');

            $product->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection('featured-image');
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->clearMediaCollection('featured-image');

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
