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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $blog_category->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.blog_categories.index')
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $blog_category->clearMediaCollection();

            $blog_category->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.blog_categories.index')
            ->with('success', 'Blog Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->clearMediaCollection();

        $blog_category->delete();

        return redirect()
            ->route('admin.blog_categories.index')
            ->with('success', 'Blog Category deleted successfully.');
    }
}
