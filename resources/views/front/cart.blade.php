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
                    <form action="{{ route('account.updateCart') }}" method="POST">
                        @csrf

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
                                                    <th scope="col" class="!text-center">Quantity</th>
                                                    <th scope="col" class="!text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse (cart()->items as $product)
                                                    <tr>
                                                        <td width="1%">
                                                            <a href="{{ route('account.removeFromCart', $product->product_id) }}"
                                                                class="!text-red-600 hover:text-red-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 16 16" fill="currentColor"
                                                                    class="size-4">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                                        clip-rule="evenodd" />
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
                                                                            alt="{{ $product->product->name }}"
                                                                            loading="lazy" />
                                                                    </a>
                                                                </div>
                                                                <div class="ml-4 max-w-104 line-clamp-2 truncate">
                                                                    <a href="{{ route('products.show', $product->product) }}"
                                                                        class="font-medium text-base/6 text-gray-900">{{ $product->product->name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">${{ $product->price }}</td>
                                                        <td>
                                                            <div x-data="{ count: {{ $product->quantity }} }"
                                                                class="mx-auto flex items-center justify-center">
                                                                <button type="button"
                                                                    class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-l-lg"
                                                                    :disabled="count <= 1"
                                                                    @click="if(count > 1) count--">-</button>
                                                                <div
                                                                    class="w-12 h-12 border-t border-b border-gray-300 flex items-center justify-center text-xl bg-white">
                                                                    <span x-text="count"></span>
                                                                    <input type="hidden"
                                                                        name="quantity[{{ $product->product_id }}]"
                                                                        x-bind:value="count" />
                                                                </div>
                                                                <button type="button" @click="count++"
                                                                    class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-r-lg">+</button>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">${{ $product->total }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Products in Cart !!!
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if (cart()->items->isNotEmpty())
                                <div class="p-6 border-t border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="sr-only">For Coupon Apply</span>
                                        </div>
                                        {{-- Update cart --}}
                                        <button type="submit" class="btn-primary !px-6">Update Cart</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
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

                            <a href="{{ route('account.checkout') }}" class="btn-primary mt-8">Proceed to
                                Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
