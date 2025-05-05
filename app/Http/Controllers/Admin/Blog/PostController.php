<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category as BlogCategory;
use App\Models\Blog\Post as BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_posts = BlogPost::latest()
            ->paginate()
            ->withQueryString();

        return view('admin.blogs.posts.index', compact('blog_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_post = new BlogPost();

        $blog_categories = BlogCategory::all()->pluck('name', 'id');

        return view('admin.blogs.posts.form', compact('blog_post', 'blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', 'unique:blog_posts,slug'],
            'content'           => ['nullable', 'string'],
            'blog_category_id'  => ['nullable', 'exists:blog_categories,id'],
            'published_at'      => ['required'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
            'status'            => ['required']
        ]);

        $blog_post = BlogPost::create($validated);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $blog_post->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection('featured-image');
        }

        return redirect()
            ->route('admin.blog_posts.index')
            ->with('success', 'Blog Product created successfully.');
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
    public function edit(BlogPost $blog_post)
    {

        $blog_categories = BlogCategory::all()->pluck('name', 'id');

        return view('admin.blogs.posts.form', compact('blog_post', 'blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog_post)
    {
        $validated = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', 'unique:blog_posts,slug,' . $blog_post->id],
            'content'           => ['nullable', 'string'],
            'blog_category_id'  => ['nullable', 'exists:blog_categories,id'],
            'published_at'      => ['required'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
            'status'            => ['required']
        ]);

        $blog_post->fill($validated);
        $blog_post->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $blog_post->clearMediaCollection('featured-image');

            $blog_post->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection('featured-image');
        }

        return redirect()
            ->route('admin.blog_posts.index')
            ->with('success', 'Blog Posts updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog_post)
    {
        $blog_post->clearMediaCollection('featured-image');

        $blog_post->delete();

        return redirect()
            ->route('admin.blog_posts.index')
            ->with('success', 'Blog Post deleted successfully.');
    }
}
