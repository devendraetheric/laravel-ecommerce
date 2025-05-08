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

            $title = 'Order ' . '#' . $order->order_number;

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.orders.index')" />

        <div class="lg:grid lg:grid-cols-3 content-center gap-6">
            <div class="lg:col-span-2">
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">

                    <div class="p-6 border-b border-gray-200 flex justify-between items-center w-full">
                        <h3 class="text-base font-semibold text-gray-800">Order Detail</h3>

                        <a href="{{ route('admin.orders.pdf', $order) }}" class="btn-primary gap-1 flex item-center">
                            <span>PDF</span>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="-mx-6 -my-6 overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="record-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col" class="!text-right">Price</th>
                                            <th scope="col" class="!text-center">Qty</th>
                                            <th scope="col" class="!text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="!font-semibold">{{ $item->product->name }}</td>
                                                <td class="text-right">{{ $item->price }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-right">${{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                Subtotal</th>
                                            <td class="text-right">${{ $order->sub_total }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                Grandtotal</th>
                                            <td class="text-right">${{ $order->grand_total }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-------- payment table ----------->

                @if ($order->payments->count() > 0)
                    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Payment Log</h3>
                        </div>
                        <div class="p-6">
                            <div class="-mx-6 -my-6 overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <table class="record-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Payment #</th>
                                                <th scope="col">Reference</th>
                                                <th scope="col">Method</th>
                                                <th scope="col" class="!text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->payments as $paymentObj)
                                                <tr>
                                                    <td class="!font-semibold">{{ $paymentObj->payment_number }}</td>
                                                    <td>{{ $paymentObj->reference }}</td>
                                                    <td>{{ $paymentObj->method }}</td>
                                                    <td class="text-right">${{ $paymentObj->amount }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-------- payment form ----------->

                @includeUnless(
                    $order->payment_status === \App\Enums\PaymentStatus::PAID,
                    'admin.orders.payment_form')

            </div>

            <div>
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-800">Customer Detail</h3>
                    </div>

                    <div class="p-6">
                        <h2 class="sr-only">Summary</h2>
                        <dl class="flex flex-wrap space-y-4">
                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Client</span>
                                    <svg class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                                <dd class="text-base/6 font-medium text-gray-900">{{ $order->user->name }}</dd>
                            </div>

                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Total Orders</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>

                                </dt>
                                <dd class="text-base/6 font-medium text-gray-900">
                                    {{ $order->user->orders->count() }} Orders</dd>
                            </div>
                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Due date</span>
                                    <svg class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path
                                            d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z" />
                                        <path fill-rule="evenodd"
                                            d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-900">

                                    <time
                                        datetime="2023-01-31">{{ $order->order_date->format(setting('general.date_format')) }}</time>
                                </dd>
                            </div>
                        </dl>

                        <div class="mt-5">
                            <h3 class="text-lg/6 font-semibold text-gray-800 mb-4">Contact Info</h3>
                            <p class="text-base/6 text-gray-700">Email : {{ $order->user->email }}</p>
                            <p class="text-base/6 text-gray-700">Mobile : {{ $order->user->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg/6 font-semibold text-gray-800 mb-4">Shipping address</h3>

                        <p class="text-base/6 text-gray-700">
                            {{ $order->address?->contact_name }}<br>
                            {{ $order->address?->address_line_1 }} , {{ $order->address?->address_line_2 }}
                            {{ $order->address?->city }}
                            <br>{{ $order->address?->state?->name }},
                            {{ $order->address?->country?->iso2 }} -
                            {{ $order->address?->zip_code }}<br>
                            Phone Number : {{ $order->address?->phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>
