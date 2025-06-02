<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => route('account.orders.index'), 'text' => 'Your Orders'],
                ['url' => '#', 'text' => $order->order_number],
            ],
            'title' => 'Order # : ' . $order->order_number,
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="my-10 lg:grid lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
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
                                                        <td>
                                                            @php
                                                                $product = $item->product;
                                                            @endphp
                                                            <div class="flex items-center">
                                                                <div class="shrink-0">
                                                                    <a href="{{ route('products.show', $product) }}">
                                                                        <img class="h-18 w-auto rounded-lg"
                                                                            src="{{ $product?->thumbnailURL('thumb') }}"
                                                                            alt="{{ $product->name }}" loading="lazy" />
                                                                    </a>
                                                                </div>
                                                                <div class="ml-4 max-w-112 text-wrap">
                                                                    <a href="{{ route('products.show', $product) }}"
                                                                        class="font-medium text-base/6 text-gray-900">{{ $product->name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="!text-right">@money($item->price)</td>
                                                        <td class="!text-center">{{ $item->quantity }}</td>
                                                        <td class="!text-right">@money($item->total)</td>
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
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl/6 font-semibold text-gray-800">Shipping Address</h3>
                            </div>
                            <div class="p-6">
                                <p>
                                    {{ $order->address?->contact_name }}<br>
                                    {{ $order->address?->address_line_1 }} , {{ $order->address?->address_line_2 }}
                                    {{ $order->address?->city }}
                                    <br>{{ $order->address?->state?->iso2 }},
                                    {{ $order->address?->country?->iso2 }} -
                                    {{ $order->address?->zip_code }}<br>
                                    Phone # : {{ $order->address?->phone }}
                                </p>
                            </div>
                        </div>

                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-xl/6 font-semibold text-gray-800">Order Summary</h3>
                            </div>
                            <div class="p-6">
                                <dl class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                        <dd class="text-base/6 font-medium text-gray-900">@money($order->sub_total)</dd>
                                    </div>
                                    @foreach ($order->tax_breakdown as $tax)
                                        <div class="flex items-center justify-between">
                                            <dt class="text-base/6 text-gray-600">{{ $tax['name'] }}</dt>
                                            <dd class="text-base/6 font-medium text-gray-900">@money($tax['total_amount'])</dd>
                                        </div>
                                    @endforeach
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Delivery Charge</dt>
                                        <dd class="text-base/6 font-bold text-gray-900">@money($order->delivery_charge)</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                        <dd class="text-base/6 font-bold text-gray-900">@money($order->grand_total)</dd>
                                    </div>
                                </dl>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
