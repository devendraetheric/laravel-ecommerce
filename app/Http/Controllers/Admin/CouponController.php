<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()
            ->paginate()
            ->withQueryString();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon();

        return view('admin.coupons.form', compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'code'               => ['required', 'string'],
            'description'        => ['nullable'],
            'type'               => ['required'],
            'value'              => ['required', 'numeric'],
            'start_date'         => ['required'],
            'end_date'           => ['required'],
            'total_quantity'     => ['required', 'numeric'],
            'use_per_user'       => ['required', 'numeric'],
            'used_quantity'      => ['required', 'numeric'],
            'max_discount_value' => ['required', 'numeric'],
            'min_cart_value'     => ['required', 'numeric'],
            'max_cart_value'     => ['required', 'numeric'],
            'is_for_new_user'    => ['required'],
        ]);

        $coupon = Coupon::create($validated);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
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
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.form', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code'               => ['required', 'string'],
            'description'        => ['nullable'],
            'type'               => ['required'],
            'value'              => ['required', 'numeric'],
            'start_date'         => ['required'],
            'end_date'           => ['required'],
            'total_quantity'     => ['required', 'numeric'],
            'use_per_user'       => ['required', 'numeric'],
            'used_quantity'      => ['required', 'numeric'],
            'max_discount_value' => ['required', 'numeric'],
            'min_cart_value'     => ['required', 'numeric'],
            'max_cart_value'     => ['required', 'numeric'],
            'is_for_new_user'    => ['required'],
        ]);


        $coupon->fill($validated);
        $coupon->save();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', __('Coupon deleted successfully.'));
    }
}
