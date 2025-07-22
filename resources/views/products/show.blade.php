<x-layouts.front>
    <x-slot name="title">
        {{ $product->seo_title ?? $product->name . ' - ' . setting('general.site_name') }}
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
            <div class="md:grid md:grid-cols-2 gap-6 my-10">
                {{-- Left Side --}}
                <div class="gallery-container">

                    <!-- Main Gallery -->
                    <div class="swiper gallery-main mb-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ $product->thumbnailURL() }}" alt="{{ $product?->name }}" loading="lazy" />
                            </div>
                            @foreach ($product?->getMedia('product-images') as $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->getUrl() }}" alt="{{ $product?->name }}" loading="lazy" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="hidden md:flex md:flex-col">
                        <div class="swiper gallery-thumb">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product?->name }}" />
                                </div>
                                @foreach ($product?->getMedia('product-images') as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ $image->getUrl('thumb') }}" alt="{{ $product?->name }}"
                                            loading="lazy" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="mt-6 md:mt-0">
                    <h1 class="text-2xl lg:text-4xl font-semibold text-gray-800 mb-3">{{ $product->name }}</h1>
                    {{-- <h2 class="text-gray-800 text-2xl font-semibold mb-3">{{ $product->name }}</h2> --}}
                    <div class="flex items-center gap-2.5 mb-6">
                        <p class="flex gap-4 items-center">
                            <span class="text-gray-800 text-3xl">@money($product->selling_price)</span>
                            @if ($product->regular_price > $product->selling_price)
                                <span class="text-2xl text-accent-500 line-through">@money($product->regular_price)</span>
                                <span class="text-xl bg-red-100 text-red-600 px-2 py-1 rounded-full font-medium">
                                    {{ round((($product->regular_price - $product->selling_price) / $product->regular_price) * 100) }}%
                                    OFF
                                </span>
                            @endif
                        </p>
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
                                    <i data-lucide="shopping-cart" class="size-5"></i>
                                </span>
                                <span class="text-white text-base">Add To Cart</span>
                            </button>

                            <a href="{{ route('account.addToWishlist', $product->id) }}"
                                class="inline-flex items-center rounded-md bg-white px-4 py-3.5 text-sm font-bold text-primary-600 border border-primary-300 hover:bg-primary-50 gap-2">
                                <i data-lucide="heart" class="size-5"></i>
                                <span>Add to Wishlist</span>
                            </a>
                        </div>
                    </form>

                    @if ($product->sku)
                        <p class="text-base/6 text-gray-700"><span class="text-gray-800 font-semibold">SKU</span> :
                            {{ $product?->sku }}</p>
                    @endif
                    @if ($product->barcode)
                        <p class="text-base/6 text-gray-700">
                            <span class="text-gray-800 font-semibold">Barcode (ISBN, UPC, GTIN, etc.)</span> :
                            {{ $product?->barcode }}
                        </p>
                    @endif
                    @if ($product->category_id)
                        <p class="text-base/6 text-gray-700"><span class="text-gray-800 font-semibold">Category</span> :
                            <a class="text-primary-600 hover:underline"
                                href="{{ route('products.byCategory', $product?->category) }}">{{ $product?->category?->name }}</a>
                        </p>
                    @endif
                    @if ($product->brand_id)
                        <p class="text-base/6 text-gray-700"><span class="text-gray-800 font-semibold">Brand</span> :
                            <a class="text-primary-600 hover:underline"
                                href="{{ route('products.byBrand', $product?->brand) }}">{{ $product?->brand?->name }}</a>
                        </p>
                    @endif
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
                    Related <span class="text-gradient">Products</span></h2>
                <div class="flex gap-6">
                    <button class="recentSwiper-button-prev slider-nav">
                        <i data-lucide="chevron-left" class="size-6"></i>
                    </button>
                    <button class="recentSwiper-button-next slider-nav">
                        <i data-lucide="chevron-right" class="size-6"></i>
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

    @push('scripts')
        @vite('resources/js/single-product.js')
    @endpush
</x-layouts.front>
