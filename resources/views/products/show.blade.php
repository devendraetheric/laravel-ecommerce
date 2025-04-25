@inject('settings', 'App\Settings\GeneralSetting')
<x-layouts.front>
    <x-slot name="title">
        {{ $product->seo_title ?? $product->name . ' - ' . $settings->site_name }}
    </x-slot>
    <x-slot name="description">
        {{ $product->seo_description }}
    </x-slot>

    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('products.index'), 'text' => 'Products'],
                ['url' => '#', 'text' => $product->name],
            ],
            'title' => $product->name,
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- product details section start -->
    <section>
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="md:grid md:grid-cols-2 gap-6 pt-10">
                {{-- Left Side --}}
                <div class="gallery-container overflow-hidden">

                    <div class="flex gap-2">
                        <div class="hidden md:flex md:flex-col overflow-y-hidden max-h-120">
                            <div class="swiper gallery-thumb">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide !h-auto">
                                        <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product?->name }}"
                                            class="block w-20 rounded-md" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-hidden">
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
                    <h2 class="text-gray-800 text-3xl font-semibold mb-3">{{ $product->name }}</h2>
                    <div class="flex items-center gap-2.5 mb-6">
                        <p class="flex gap-4 items-center">
                            <span class="text-gray-800 text-3xl">${{ $product->selling_price }}</span>
                            <span
                                class="text-red-600 opacity-70 text-3xl line-through">${{ $product->regular_price }}</span>
                        </p>
                        {{-- <span class="bg-[#F5813F] px-2.5 py-1.5 rounded-[4px] text-white text-sm">50% Off</span> --}}
                    </div>

                    <div class="mb-6 prose max-w-none">
                        {!! $product->short_description !!}
                    </div>
                    <form action="{{ route('products.addToCart') }}" method="POST">
                        @csrf

                        <div x-data="{ count: 1 }" class="flex items-center my-6 text-gray-700">
                            <button type="button"
                                class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-l-lg"
                                :disabled="count <= 1" @click="if(count > 1) count--">-</button>
                            <div
                                class="w-12 h-12 border-t border-b border-gray-300 flex items-center justify-center text-xl bg-white">
                                <span x-text="count"></span>
                                <input type="hidden" name="quantity" :value="count" />
                            </div>
                            <button type="button" @click="count++"
                                class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-r-lg">+</button>
                        </div>

                        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 mb-6">

                            <input type="hidden" name="product_id" value="{{ $product->id }}" />

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

                                <span>Add to Wishlist</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="my-10">
                <h3 class="pt-3 text-2xl font-semibold text-gray-black font-display">Product Details</h3>
                <div class="mt-4 prose max-w-none">
                    {!! $product->long_description !!}
                </div>
            </div>
        </div>
    </section>
    <!-- product details section end -->

    <!-- recent products section start -->
    <section class="lg:py-20 py-6 sm:py-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    Related Products</h2>
                <div class="flex gap-6">
                    <button class="recentSwiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </button>
                    <button class="recentSwiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="swiper recentSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($product->relatedProducts(8) as $item)
                        <div class="swiper-slide">
                            <x-products.card :product="$item" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- recent products section end -->
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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

            new Swiper(".recentSwiper", {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: ".recentSwiper-button-next",
                    prevEl: ".recentSwiper-button-prev",
                },
                breakpoints: {
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 18,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },
                },
            });
        </script>
    @endpush
</x-layouts.front>
