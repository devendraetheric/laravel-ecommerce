<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => '#', 'text' => 'Your Wishlists'],
            ],
            'title' => 'Your Wishlists',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <x-account.nav />

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl/6 font-semibold text-gray-800">Your Wishlists</h3>
                </div>
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->wishlists as $product)
                                        <tr>
                                            <td width="1%">
                                                <a href="{{ route('account.removeFromWishlist', $product->id) }}"
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
                                                        <a href="{{ route('products.show', $product) }}">
                                                            <img class="h-18 w-auto rounded-lg"
                                                                src="{{ $product?->thumbnailURL('thumb') }}"
                                                                alt="{{ $product->name }}" />
                                                        </a>
                                                    </div>
                                                    <div class="ml-4">
                                                        <a href="{{ route('products.show', $product) }}"
                                                            class="font-medium text-base/6 text-gray-900">{{ $product->name }}
                                                        </a>
                                                        <div class="mt-1 text-base/6 text-gray-500 whitespace-normal">
                                                            {{ str($product->short_description)->words(25) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ $product->selling_price }}</td>
                                            <td>
                                                <form action="{{ route('products.addToCart') }}" method="POST"
                                                    class="flex justify-end">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1" />
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id }}" />

                                                    <button type="submit" class="btn-primary">Add to Cart</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Products in Wishlist !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
