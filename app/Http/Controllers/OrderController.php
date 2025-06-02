<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Enums\TaxType;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Tax;
use App\Notifications\OrderPlaced;
use App\Services\PaypalService;
use App\Services\PhonePeService;
use App\Services\RazorpayService;
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

    public function getTaxes()
    {
        $addressId = request('address_id');

        $address = Address::find($addressId);

        $taxRate = config('usa_tax')[$address?->state?->iso2] ?? 0.0;

        // return if no tax rate is found
        if (!$taxRate) {
            return response()->json([
                'taxes' => [],
                'total_tax' => 0,
            ]);
        }

        $tax = Tax::where('rate', $taxRate)
            ->where('type', TaxType::VAT)
            ->first();

        if (!$tax) {
            $tax = Tax::create(
                [
                    'name' => "VAT " . $taxRate . "%",
                    'type' => TaxType::VAT,
                    'rate' => $taxRate,
                ]
            );
        }

        $taxSummary = [];


        foreach (cart()->items as $item) {
            $taxAmount = round(($item->total * $tax->rate) / 100, 2);

            if (!isset($taxSummary[$tax->id])) {
                $taxSummary[$tax->id] = [
                    'name' => $tax->name,
                    'rate' => $tax->rate,
                    'amount' => 0,
                ];
            }

            $taxSummary[$tax->id]['amount'] += $taxAmount;
            $taxSummary[$tax->id]['amount_display'] = get_currency_symbol() . " " . number_format($taxAmount, 2);
        }

        $taxes = array_values($taxSummary);
        $totalTax = collect($taxes)->sum('amount');

        return response()->json([
            'taxes' => $taxes,
            'total_tax' => $totalTax,
        ]);
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
            'delivery_charge' => getDeliveryCharge(),
            'grand_total' => $cart->total + getDeliveryCharge(),
            'notes' => $validated['notes']
        ]);

        $cartItems = $cart->items->map(function ($item) {
            return $item->only(['product_id', 'quantity', 'price', 'total']);
        });

        $order->items()->createMany($cartItems->toArray());

        $address = auth()->user()->addresses()->find($validated['address_id']);

        $order->address()->create($address->replicate()->makeHidden(['id', 'addressable_id', 'addressable_type', 'is_default', 'created_at', 'updated_at'])->toArray());

        /**
         * Apply Taxes to Order Items
         */
        $order->items->each(function ($item) use ($address) {
            applyTaxesToObject($item, $item->total, $address->state);
        });

        $order->grand_total = $cart->total + getDeliveryCharge() + $order->total_tax_amount;
        $order->save();


        /**
         * Delete Cart and Cart Items
         */
        $cart->items()->delete();
        $cart->delete();

        if ($order->payment_method == 'cod') {
            return redirect()->route('account.orders.show', $order)
                ->with('success', 'Order placed successfully. Please pay cash on delivery.');
        }

        return redirect()->route('account.orders.pay', $order)
            ->with('success', 'Order placed successfully.');
    }

    public function pay(Order $order, PhonePeService $phonePe, PaypalService $paypal, RazorpayService $razorpay)
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

        if ($order->payment_method == 'Razorpay')
            $redirectURL = $razorpay->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total * 100,
                'currency' => app_country()->currency,
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);



        return redirect($redirectURL);
    }

    public function verifyPayment(Request $request, Order $order, PhonePeService $phonePe, PaypalService $paypal, RazorpayService $razorpay)
    {
        if ($order->payment_method == 'Paypal') {
            $response = $paypal->captureOrder($request->token);

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

        if ($order->payment_method == 'Razorpay') {

            $response = $razorpay->checkStatus($request->razorpay_payment_id);

            if ($response && $response['status'] == 'captured') {
                $order->payments()->create([
                    'payment_number' => Payment::generatePaymentNumber(),
                    'reference' =>  $request->razorpay_payment_id,
                    'amount' =>  $order->grand_total,
                    'method' =>  'Razorpay',
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
