<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => route('account.orders.index'), 'text' => 'Your Orders'],
                ['url' => '#', 'text' => $order->order_number],
            ],
            'title' => 'Order # ' . $order->order_number,
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="mt-6 lg:grid lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8">
                        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl/6 font-semibold text-gray-800">Order Detail</h3>
                            </div>
                            <div class="p-6">
                                <div class="-mx-6 -my-6 overflow-x-auto">
                                    <div class="inline-block min-w-full align-middle">
                                        <table class="record-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col" class="!text-right">Price</th>
                                                    <th scope="col" class="!text-center">Quantity</th>
                                                    <th scope="col" class="!text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td class="!text-right">${{ $item->price }}</td>
                                                        <td class="!text-center">{{ $item->quantity }}</td>
                                                        <td class="!text-right">${{ $item->total }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 mt-6 lg:mt-0 space-y-6">
                        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl/6 font-semibold text-gray-800">Shipping Address</h3>
                            </div>
                            <div class="p-6">
                                <p>
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

                        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl/6 font-semibold text-gray-800">Order Summary</h3>
                            </div>
                            <div class="p-6">
                                <dl class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                        <dd class="text-base/6 font-medium text-gray-900">${{ $order->sub_total }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                        <dd class="text-base/6 font-bold text-gray-900">${{ $order->grand_total }}</dd>
                                    </div>
                                </dl>

                            </div>
                        </div>
                    </div>
                </div>
            </div>





            {{-- <div class="w-full">
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl/6 font-semibold text-gray-800">Order Details</h3>
                    </div>
                    <div class="p-6">
                        <div class="-mx-6 -my-6 overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="record-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order #</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col" width="40%">Products</th>
                                            <th scope="col" class="!text-center">Status</th>
                                            <th scope="col" class="!text-right">Order Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td class="!font-semibold">
                                                    <a class="link-primary"
                                                        href="{{ route('account.show', $order) }}">{{ $order->order_number }}</a>
                                                </td>

                                                <td>{{ $order->order_date->format('Y-m-d') }}</td>
                                                <td class="!whitespace-normal !break-words">
                                                    {{ $order->items()->count() }}
                                                    {{ $order->items->pluck('product.name')->implode(',') }}
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="inline-flex items-center rounded-md bg-{{ $order->status->color() }}-50 px-2 py-1 text-xs font-medium text-{{ $order->status->color() }}-600 ring-1 ring-{{ $order->status->color() }}-500/10 ring-inset">{{ $order->status->label() }}</span>
                                                </td>
                                                <td class="text-right">${{ $order->grand_total }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Orders Found !!!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>




</x-layouts.front>
