<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()
            ->withCount('products')
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        return view('admin.categories.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . Category::class],
            'slug'              => ['required', 'string', 'unique:' . Category::class],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $category = Category::create($validated);

        if ($request->hasFile('featured-image')) {
            $category->addMediaFromRequest('featured-image')
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . Category::class . ',name,' . $category->id],
            'slug'              => ['required', 'string', 'unique:' . Category::class . ',slug,' . $category->id],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $category->fill($validated);
        $category->save();

        if ($request->hasFile('featured-image')) {

            $category->clearMediaCollection();
            $category->addMediaFromRequest('featured-image')
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->clearMediaCollection();

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }


    /**
     * Search Category by name
     */
    public function search(Request $request)
    {
        $categories = Category::where('name', 'like', '%' . $request->q . '%')
            ->select(['id', 'name'])
            ->latest()
            ->take(10)
            ->get();

        return response()->json($categories);
    }
}
