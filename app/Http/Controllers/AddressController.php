<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $addresses = auth()->user()->addresses;

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $address = new Address();

        return view('addresses.form', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'country_id' => ['required'],
            'contact_name' => ['required', 'string', 'max:60'],
            'phone' => ['required'],
            'address_line_1' => ['required', 'string', 'max:50'],
            'address_line_2' => ['nullable', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:50'],
            'zip_code' => ['required', 'string', 'max:10'],
            'state_id' => ['required'],
        ]);

        auth()->user()->addresses()->create($validated);

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address Added Successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address): View
    {
        return view('addresses.form', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'country_id' => ['required'],
            'contact_name' => ['required', 'string', 'max:60'],
            'phone' => ['required'],
            'address_line_1' => ['required', 'string', 'max:50'],
            'address_line_2' => ['nullable', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:50'],
            'zip_code' => ['required', 'string', 'max:10'],
            'state_id' => ['required'],
        ]);

        auth()->user()->addresses()->update($validated);

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('account.addresses.index')
            ->with('success', 'Address deleted Successfully!!!');
    }
}
