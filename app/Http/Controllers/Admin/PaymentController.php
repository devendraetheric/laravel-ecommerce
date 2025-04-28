<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {

        $validated = $request->validate([
            'payment_number' => ['required', 'string', 'max:255'],
            'reference'      => ['required', 'string', 'max:255'],
            'amount'         => ['required', 'numeric', 'min:0'],
            'method'         => ['required'],
            'notes'          => ['nullable', 'string'],
        ]);


        $order->payments()->create($validated);


        if (($order->paid_amount + $request->amount) >= $order->grand_total) {
            $order->payment_status = 'paid';
        }else{
            $order->payment_status = 'partial paid';
        }

        $order->increment('paid_amount', $request->amount);

        $order->save();

        return redirect()->back()
            ->with('success', __('Payment  successfully.'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
