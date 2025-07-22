<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category as BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = BlogCategory::latest()
            ->withCount('posts')
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.blogs.categories.index', compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_category = new BlogCategory();

        return view('admin.blogs.categories.form', compact('blog_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . BlogCategory::class],
            'slug'              => ['required', 'string', 'unique:' . BlogCategory::class],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $blog_category = BlogCategory::create($validated);

        return redirect()
            ->route('admin.blogs.categories.index')
            ->with('success', 'Blog Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blog_category)
    {

        return view('admin.blogs.categories.form', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blog_category)
    {
        /* dd($request->all()); */

        $validated = $request->validate([
            'name'              => ['required', 'string', 'unique:' . BlogCategory::class],
            'slug'              => ['required', 'string', 'unique:' . BlogCategory::class],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ]);

        $blog_category->fill($validated);
        $blog_category->save();

        return redirect()
            ->route('admin.blogs.categories.index')
            ->with('success', 'Blog Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        return redirect()
            ->route('admin.blogs.categories.index')
            ->with('success', 'Blog Category deleted successfully.');
    }

    /**
     * Search Blog Category by name
     */
    public function search(Request $request)
    {
        $blog_categories = BlogCategory::where('name', 'like', '%' . $request->q . '%')
            ->select(['id', 'name'])
            ->latest()
            ->take(10)
            ->get();

        return response()->json($blog_categories);
    }
}
