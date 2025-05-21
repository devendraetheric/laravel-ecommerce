<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Models\Order;
use App\Models\Payment;
use App\Notifications\OrderPlaced;
use App\Services\PaypalService;
use App\Services\PhonePeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = cart();
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty.');
        }

        return view('orders.checkout');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address_id' => ['required'],
            'payment_method' => ['required'],
            'notes' => ['nullable', 'string']
        ]);

        $cart = cart();

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'order_date' => now()->format('Y-m-d'),
            'user_id' => auth()->id(),
            'payment_method' => $validated['payment_method'],
            'sub_total' => $cart->total,
            'delivery_charge' => 50,
            'grand_total' => $cart->total + 50,
            'notes' => $validated['notes']
        ]);

        $cartItems = $cart->items->map(function ($item) {
            return $item->only(['product_id', 'quantity', 'price', 'total']);
        });

        $order->items()->createMany($cartItems->toArray());

        $address = auth()->user()->addresses()->find($validated['address_id']);

        $order->address()->create($address->replicate()->makeHidden(['id', 'addressable_id', 'addressable_type', 'is_default', 'created_at', 'updated_at'])->toArray());

        /**
         * Delete Cart and Cart Items
         */
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('account.orders.pay', $order)
            ->with('success', 'Order placed successfully.');
    }

    public function pay(Order $order, PhonePeService $phonePe, PaypalService $paypal)
    {
        if ($order->payment_method == 'Paypal')
            $redirectURL = $paypal->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total,
                'currency' => app_country()->currency,
                // 'currency' => 'USD',
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);

        if ($order->payment_method == 'Phonepe')
            $redirectURL = $phonePe->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total * 100, // ₹100 in paise
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);

        return redirect($redirectURL);
    }

    public function verifyPayment(Order $order, PhonePeService $phonePe, PaypalService $paypal)
    {
        if ($order->payment_method == 'Paypal') {
            $response = $paypal->captureOrder(request()->token);

            if ($response && $response['status'] == 'COMPLETED') {
                $order->payments()->create([
                    'payment_number' => Payment::generatePaymentNumber(),
                    'reference' =>  $response['id'],
                    'amount' =>  $order->grand_total,
                    'method' =>  'Paypal',
                ]);

                $order->increment('paid_amount', $order->grand_total);
                $order->payment_status = PaymentStatus::PAID;

                $order->save();

                return redirect()->route('account.orders.show', $order)
                    ->with('success', 'Payment completed successfully.');
            }
        }

        if ($order->payment_method == 'Phonepe') {
            $response = $phonePe->checkStatus($order->order_number);

            if ($response && $response['state'] == 'COMPLETED') {
                $order->payments()->create([
                    'payment_number' => Payment::generatePaymentNumber(),
                    'reference' =>  $response['orderId'],
                    'amount' =>  $order->grand_total,
                    'method' =>  'Phonepe',
                ]);

                $order->increment('paid_amount', $order->grand_total);
                $order->payment_status = PaymentStatus::PAID;

                $order->save();

                return redirect()->route('account.orders.show', $order)
                    ->with('success', 'Payment completed successfully.');
            }
        }

        return redirect()->route('account.orders.show', $order)
            ->with('error', 'Payment failed.');
    }

    public function index(): View
    {
        $orders = auth()->user()->orders()->latest()->paginate(10)
            ->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $userOrder = auth()->user()->orders()->where('id', $order->id)->first();

        if (is_null($userOrder)) {
            abort(404);
        }

        return view('orders.show', compact('order'));
    }
}
