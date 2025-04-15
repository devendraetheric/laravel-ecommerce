<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('products.list'), 'text' => 'Products'],
                ['url' => '#', 'text' => $product->name],
            ],
            'title' => $product->name,
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- product details section start -->
    <div>
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="md:grid md:grid-cols-2 gap-6 pt-10">
                {{-- Left Side --}}
                <div class="gallery-container overflow-hidden">

                    <div class="md:grid md:grid-cols-5 gap-6">
                        <div class="hidden md:flex md:flex-col overflow-y-hidden max-h-120">
                            <div class="swiper gallery-thumb">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide !w-auto">
                                        <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product?->name }}"
                                            class="w-20 rounded-md" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-4">
                            <!-- Main Gallery -->
                            <div class="swiper gallery-main">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ $product->thumbnailURL() }}" alt="{{ $product?->name }}"
                                            class="w-full rounded-md" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="mt-6 md:mt-0">
                    <h2 class="text-gray-800 text-3xl font-semibold mb-3 capitalize">{{ $product->name }}</h2>
                    <div class="flex items-center gap-2.5 mb-6">
                        <p class="flex gap-4 items-center">
                            <span class="text-gray-800 text-3xl">${{ $product->selling_price }}</span>
                            <span
                                class="text-red-600 opacity-70 text-3xl line-through">${{ $product->regular_price }}</span>
                        </p>
                        {{-- <span class="bg-[#F5813F] px-2.5 py-1.5 rounded-[4px] text-white text-sm">50% Off</span> --}}
                    </div>

                    <div class="mb-6 prose max-w-none">
                        {!! str($product->short_description)->markdown() !!}
                    </div>
                    <form action="{{ route('products.addToCart') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 mb-6">

                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <input type="number" name="quantity" id="quantity"
                                class="block w-24 rounded-md bg-white px-3 py-3.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6"
                                value="1" min="1" required />
                            <button
                                class="inline-flex items-center gap-2 bg-primary-600 border rounded-md leading-tight text-white font-bold px-4 py-3.5 hover:bg-primary-500 outline-none cursor-pointer">
                                <span class="text-white text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </span>
                                <span class="text-white text-base">Add To Cart</span>
                            </button>

                            <a href="{{ route('account.addToWishlist', $product->id) }}"
                                class="inline-flex items-center rounded-md bg-white px-4 py-3.5 text-sm font-bold text-primary-600 border border-primary-300 hover:bg-primary-50 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>

                                <span class="hidden md:inline-flex">Add to Wishlist</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="my-10">
                <h2 class="pt-3 text-2xl font-semibold text-gray-black font-display">Product Details</h2>
                <div class="mt-4 prose max-w-none">
                    {!! str($product->long_description)->markdown() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- product details section end -->
    @push('scripts')
        <script>
            const thumbSwiper = new Swiper('.gallery-thumb', {
                spaceBetween: 20,
                slidesPerView: 5,
                direction: 'vertical'
            });

            const mainSwiper = new Swiper('.gallery-main', {
                spaceBetween: 10,
                thumbs: {
                    swiper: thumbSwiper,
                },
            });
        </script>
    @endpush
</x-layouts.front>
