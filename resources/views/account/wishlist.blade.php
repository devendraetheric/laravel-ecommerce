<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Your Wishlists'],
            ],
            'title' => 'Your Wishlists',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)


    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="my-10 overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
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
                                            <th scope="col" class="!text-right">Price</th>
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
                                                        <i data-lucide="trash-2" class="size-4"></i>
                                                    </a>
                                                </td>
                                                <td width="50%">
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
                                                <td class="text-right">@money($product->selling_price)</td>
                                                <td width="10%">
                                                    <form action="{{ route('products.addToCart') }}" method="POST"
                                                        class="flex justify-end">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="1" />
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}" />

                                                        <button type="submit" class="btn-primary  !p-2 !text-sm">Add to
                                                            Cart</button>
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
        </div>
    </section>

</x-layouts.front>
