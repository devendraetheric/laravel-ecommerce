<x-layouts.admin>

    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.orders.index'),
                    'text' => 'Orders',
                ],
                [
                    'text' => $order->id ? 'Show' : '',
                ],
            ];

            $title = 'Order ' . '#' . $order->order_number . ' ' .  $order->payment_status;

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.orders.index')" />


        <div class="grid grid-cols-3 content-center gap-4">
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm col-span-2">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Order Detail</h3>
                </div>
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order->items as $item)
                                        <tr class="!font-semibold">
                                            <td>{{ $item->product->name }}</td>

                                            <td>{{ $item->price }}</td>

                                            <td>{{ $item->quantity }}</td>

                                            <td>{{ $item->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end items-center p-15 mb-2">
                            <div class="space-y-2">
                                <div class="flex justify-start space-x-4">
                                    <span class="w-[100px] text-gray-700 font-medium">Subtotal:</span>
                                    <h6 class="mb-0">{{ $order->sub_total }}</h6>
                                </div>

                                <div class="flex justify-start space-x-4">
                                    <h6 class="w-[100px] mb-0 font-semibold">Total:</h6>
                                    <h6 class="mb-0 font-semibold">{{ $order->grand_total }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Customer Detail</h3>
                </div>

                <div class="p-6">
                    <div class="flex">
                        <img class="w-18 h-15 rounded-full"
                            src="https://png.pngtree.com/png-clipart/20231019/original/pngtree-user-profile-avatar-png-image_13369988.png"
                            alt="Rounded avatar">

                        <p class="font-semibold mt-5">{{ $order->user->name }}</p>
                    </div>

                    <div class="mt-5 flex gap-5">
                        <img class="w-18 h-15 rounded-full"
                            src="https://png.pngtree.com/element_our/20190528/ourmid/pngtree-shopping-cart-icon-image_1166717.jpg">

                        <p class="mt-5">{{ $userOrdersCount }} Orders</p>
                    </div>

                    <div class="mt-5">
                        <div class="">
                            <h3 class="text-base font-semibold text-gray-800">Contact Info</h3>
                        </div>
                        <br>
                        <p>Email : {{ $order->user->email }}</p>
                        <p>Mobile : {{ $order->user->phone }}</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="col-start-3 mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Shipping address</h3>
                    <br>
                    <p>{{ $order->address->name }}</p>
                    <p>{{ $order->address->address_line_1 }},{{ $order->address->address_line_2 }}</p>
                    <p>{{ $order->address->state->name }}</p>
                    <p>{{ $order->address->country->name }}</p>
                </div>
            </div>
        </div>
    </div>

</x-layouts.admin>
