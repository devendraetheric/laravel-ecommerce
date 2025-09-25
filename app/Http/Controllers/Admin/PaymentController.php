<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\StoreRequest as PaymentStoreRequest;
use App\Http\Requests\Admin\Payment\UpdateRequest as PaymentUpdateRequest;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentStoreRequest $request, Order $order)
    {

        $order->payments()->create($request->validated());

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
