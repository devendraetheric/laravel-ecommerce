<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxes = Tax::latest()
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.taxes.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tax = new Tax();

        return view('admin.taxes.form', compact('tax'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'rate' => ['required', 'numeric'],
        ]);

        $tax = Tax::create($validated);

        return redirect()
            ->route('admin.taxes.index')
            ->with('success', 'Tax created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        return view('admin.taxes.form', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tax $tax)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'rate' => ['required', 'numeric'],
        ]);

        $tax->fill($validated);
        $tax->save();

        return redirect()
            ->route('admin.taxes.index')
            ->with('success', 'Tax updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();

        return redirect()
            ->route('admin.taxes.index')
            ->with('success', 'Tax deleted successfully.');
    }
}
