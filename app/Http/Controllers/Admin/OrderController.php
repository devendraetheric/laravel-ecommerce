<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()
            ->with(['user'])
            ->paginate()
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = new Order();

        $users = User::all()->pluck('name', 'id');

        $products = Product::all(['id', 'name', 'regular_price']);

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        return view('admin.orders.form', compact('order', 'users', 'products', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number'      => ['required', 'string', 'max:255', 'unique:' . Order::class],
            'order_date'        => ['required'],
            'status'            => ['nullable', 'string'],
            'payment_status'    => ['nullable', 'string', 'default:pending'],
            'payment_method'    => ['nullable', 'string', 'default:cash'],
            'user_id'           => ['required', 'exists:users,id'],

            'address.name' => ['required', 'string', 'max:50'],
            'address.country_id' => ['required'],
            'address.contact_name' => ['required', 'string', 'max:60'],
            'address.phone' => ['required'],
            'address.address_line_1' => ['required', 'string', 'max:50'],
            'address.address_line_2' => ['nullable', 'string', 'max:50'],
            'address.city' => ['required', 'string', 'max:50'],
            'address.zip_code' => ['required', 'string', 'max:10'],
            'address.state_id' => ['required'],

            // 'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.total' => ['required', 'numeric', 'min:0'],

            'sub_total' => ['required', 'numeric', 'min:0'],
            'grand_total' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable']
        ]);

        $order = Order::create($validated);

        $order->address()->create($validated['address']);

        $order->items()->createMany($validated['items']);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::all()->pluck('name', 'id');

        $products = Product::all(['id', 'name', 'regular_price']);

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        return view('admin.orders.form', compact('order', 'users', 'products', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_number'      => ['required', 'string', 'max:255', 'unique:' . Order::class . ',order_number,' . $order->id],
            'order_date'        => ['required'],
            'status'            => ['nullable', 'string'],
            'user_id'           => ['required', 'exists:users,id'],

            'address.name' => ['required', 'string', 'max:50'],
            'address.country_id' => ['required'],
            'address.contact_name' => ['required', 'string', 'max:60'],
            'address.phone' => ['required'],
            'address.address_line_1' => ['required', 'string', 'max:50'],
            'address.address_line_2' => ['nullable', 'string', 'max:50'],
            'address.city' => ['required', 'string', 'max:50'],
            'address.zip_code' => ['required', 'string', 'max:10'],
            'address.state_id' => ['required'],

            // 'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'  => ['required', 'integer', 'min:1'],
            'items.*.price'     => ['required', 'numeric', 'min:0'],
            'items.*.total'     => ['required', 'numeric', 'min:0'],

            'sub_total'         => ['required', 'numeric', 'min:0'],
            'grand_total'       => ['required', 'numeric', 'min:0'],
            'notes'             => ['nullable']
        ]);

        $order->fill($validated);
        $order->save();

        $order->address()->update($validated['address']);

        $order->items()->delete();
        $order->items()->createMany($validated['items']);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order deleted successfully.'));
    }
}
