<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.subscribers.index', compact('subscribers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscriber = new Subscriber();

        return view('admin.subscribers.form', compact('subscriber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['nullable', 'string'],
            'email' => ['required', 'email'],
        ]);

        $subscriber = Subscriber::updateOrCreate($validated);

        return redirect()
            ->route('admin.subscribers.index')
            ->with('success', 'Subscriber created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        return view('admin.subscribers.form', compact('subscriber'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $validated = $request->validate([
            'name'  => ['nullable', 'string'],
            'email' => ['required', 'email'],
        ]);

        $subscriber->fill($validated);
        $subscriber->save();

        return redirect()
            ->route('admin.subscribers.index')
            ->with('success', 'Subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()
            ->route('admin.subscribers.index')
            ->with('success', __('Subscriber deleted successfully.'));
    }
}
