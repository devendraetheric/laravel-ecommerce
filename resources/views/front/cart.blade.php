<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => '#', 'text' => 'Your Cart'],
            ],
            'title' => 'Your Cart',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">

            <div class="mt-6 lg:grid lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8">
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl/6 font-semibold text-gray-800">Your Cart</h3>
                        </div>
                        <div class="p-6">
                            <div class="-mx-6 -my-6 overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <table class="record-table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product</th>
                                                <th scope="col" class="!text-right">Price</th>
                                                <th scope="col" class="!text-right">Quantity</th>
                                                <th scope="col" class="!text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse (cart()->items as $product)
                                                <tr>
                                                    <td width="1%">
                                                        <a href="{{ route('account.removeFromCart', $product->product_id) }}"
                                                            class="!text-red-600 hover:text-red-900">
                                                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                                <path
                                                                    d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                    <td width="50%">
                                                        <div class="flex items-center">
                                                            <div class="shrink-0">
                                                                <a
                                                                    href="{{ route('products.show', $product->product) }}">
                                                                    <img class="h-18 w-auto rounded-lg"
                                                                        src="{{ $product->product?->thumbnailURL('thumb') }}"
                                                                        alt="{{ $product->product->name }}" />
                                                                </a>
                                                            </div>
                                                            <div class="ml-4">
                                                                <a href="{{ route('products.show', $product->product) }}"
                                                                    class="font-medium text-base/6 text-gray-900 wrap-normal">{{ $product->product->name }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">${{ $product->price }}</td>
                                                    <td class="text-right">{{ $product->quantity }}</td>
                                                    <td class="text-right">${{ $product->total }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No Products in Cart !!!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 mt-6 lg:mt-0">
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl/6 font-semibold text-gray-800">Order Summary</h3>
                        </div>
                        <div class="p-6">
                            <dl class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                    <dd class="text-base/6 font-medium text-gray-900">${{ $cart->total }}</dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                    <dd class="text-base/6 font-bold text-gray-900">${{ $cart->total }}</dd>
                                </div>
                            </dl>

                            <a href="{{ route('account.checkout') }}" class="btn-primary mt-8">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
