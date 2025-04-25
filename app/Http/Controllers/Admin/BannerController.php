<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()
            ->paginate()
            ->withQueryString();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banner = new Banner();

        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'link'          => ['required', 'string', 'max:255'],
            'location'      => ['required', 'string', 'max:255'],
            'is_active'     => ['required'],
            'is_new_tab'    => ['required'],
        ]);

        $banner = Banner::create($validated);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $banner->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banners created successfully.');
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
    public function edit(Banner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'link'          => ['required', 'string', 'max:255'],
            'location'      => ['required', 'string', 'max:255'],
            'is_active'     => ['required'],
            'is_new_tab'    => ['required'],
        ]);

        $banner->fill($validated);
        $banner->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            $banner->clearMediaCollection();

            $banner->addMedia(storage_path("app/public/$path"))
                ->preservingOriginal()
                ->toMediaCollection();
        }

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->clearMediaCollection();

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
