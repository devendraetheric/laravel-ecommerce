<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()
            ->withCount('products')
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand();

        return view('admin.brands.form', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . Brand::class],
            'slug'              => ['required', 'string', 'unique:' . Brand::class],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $brand = Brand::create($validated);

        if ($request->hasFile('featured-image')) {
            $brand->addMediaFromRequest('featured-image')
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.form', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . Brand::class . ',name,' . $brand->id],
            'slug'              => ['required', 'string', 'unique:' . Brand::class . ',slug,' . $brand->id],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $brand->fill($validated);
        $brand->save();

        if ($request->hasFile('featured-image')) {
            $brand->clearMediaCollection();

            $brand->addMediaFromRequest('featured-image')
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->clearMediaCollection();

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    /**
     * Search Brand by name
     */
    public function search(Request $request)
    {
        $brands = Brand::where('name', 'like', '%' . $request->q . '%')
            ->select(['id', 'name'])
            ->latest()
            ->take(10)
            ->get();

        return response()->json($brands);
    }
}
