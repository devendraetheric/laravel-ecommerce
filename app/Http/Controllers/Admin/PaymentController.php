<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


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
            $order->payment_status = (PaymentStatus::PAID)->value;
        } else {
            $order->payment_status = (PaymentStatus::PARTIALPAID)->value;
        }

        $order->increment('paid_amount', $request->amount);

        $order->save();

        return redirect()->back()
            ->with('success', __('Payment  successfully.'));
    }
}
