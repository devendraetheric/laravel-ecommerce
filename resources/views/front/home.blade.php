@inject('settings', 'App\Settings\GeneralSetting')
<x-layouts.front>
    <x-slot name="title">
        {{ $settings->site_name }} - {{ $settings->site_description }}
    </x-slot>
    <x-slot name="description">
        {{ $settings->site_description }}
    </x-slot>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    @endpush

    @if ($sliders->isNotEmpty())
        <!-- banner section start -->
        <section class="container px-3 md:px-5 xl:px-0 mt-6 mb-10 bg-gray-200 rounded-xl relative z-10">
            <div class="swiper bannerSwiper relative z-50">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">

                            @if ($slider->link)
                                <a href="{{ $slider->link }}" @if ($slider->is_new_tab) target="_bank" @endif
                                    aria-label="{{ $slider->name }}">
                            @endif
                            <img class="w-full object-cover rounded-xl"
                                src="{{ $slider?->getMedia($slider->location)->first()?->getUrl() }}"
                                alt="{{ $slider->name }}" loading="lazy" />
                            @if ($slider->link)
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="absolute top-1/2 items-center gap-8 w-full px-3 flex justify-between">
                    <button
                        class="banner-prev cursor-pointer group !p-2 flex justify-center items-center border border-solid border-primary-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !left-5 hover:bg-primary-600 z-100">
                        <svg class="h-5 w-5 text-primary-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button
                        class="banner-next cursor-pointer group !p-2 flex justify-center items-center border border-solid border-primary-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !right-5 hover:bg-primary-600 z-100">
                        <svg class="h-5 w-5 text-primary-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M5.99984 4.00012L10 8.00029L5.99748 12.0028" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="banner-pagination absolute -bottom-3 flex justify-center z-20"></div>
            </div>
        </section>
        <!-- banner section end -->
    @endif

    @if ($brands->count() > 0)
        <!-- feature and brand area start -->
        <section class="xl:pb-20 pb-8 md:pb-12">
            <div class="container px-3 md:px-5 xl:px-0">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold mb-10">
                    Shop By Brand</h2>
                <div class="swiper brandSwiper overflow-hidden mb-6">
                    <div class="swiper-wrapper items-center">
                        @foreach ($brands as $brand)
                            <div class="swiper-slide inline-flex items-center justify-center">
                                <a href="{{ route('products.byBrand', $brand) }}">
                                    <img class="rounded-lg" src="{{ $brand->thumbnailURL('thumb') }}"
                                        alt="{{ $brand->name }}" loading="lazy" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- feature and brand area end -->
    @endif

    <!-- feature products section start -->
    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    Featured Products</h2>
                <a href="{{ route('products.index') }}"
                    class="text-base/6 text-primary-600 hover:text-primary-700">View
                    All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-center mx-auto gap-6">
                @foreach ($featuredProducts as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    <!-- feature products section end -->

    <!-- top categories product section start -->
    <section class="overflow-hidden relative lg:pb-20 md:pb-6 pb-3">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    Our Top Categories</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-center mx-auto gap-6">
                @foreach ($topCategories as $category)
                    <div class="swiper-slide border border-gray-100 rounded-xl">
                        <div class="group overflow-hidden rounded-lg">
                            <div class="w-full">
                                <a href="{{ route('products.byCategory', $category) }}">
                                    <img class="w-full object-cover transition duration-500 ease-out delay-0 group-hover:scale-110"
                                        src="{{ $category?->thumbnailURL('thumb') }}" alt="{{ $category->name }}"
                                        loading="lazy" fetchpriority="low" />
                                </a>
                            </div>

                            <div class="bg-gray-900 opacity-70 p-5 absolute bottom-0 w-full rounded-b-lg text-white">
                                <h3 class="font-normal text-xl leading-tight mb-2 line-clamp-1">
                                    <a href="{{ route('products.byCategory', $category) }}">{{ $category->name }}</a>
                                </h3>
                                <p class="text-sm leading-tight">{{ $category->products_count }} Products</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- top categories product section end -->


    <!-- Our Product section start  -->
    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    Our Products</h2>
                <a href="{{ route('products.index') }}"
                    class="text-base/6 text-primary-600 hover:text-primary-700">View
                    All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-center mx-auto gap-6">
                @foreach ($latestProducts as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    <!-- Our Product section end  -->

    <!-- Testimonials section start -->
    <section class="overflow-hidden lg:py-20 sm:py-8 py-5 bg-gray-100">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-wrap justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    What our client says about us</h2>
                <div class="flex gap-6">
                    <button class="testimonials-button-prev slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="testimonials-button-next slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="swiper testimonialSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach (config('testimonials') as $review)
                        <div class="swiper-slide">
                            <x-common.testimonial-card :review=$review />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials section end -->

    <!-- recent products section start -->
    <section class="lg:py-20 py-6 sm:py-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-gray-800 xl:text-4xl xl:leading-tight text-xl md:text-2xl font-bold">
                    Recently Added</h2>
                <div class="flex gap-6">
                    <button class="recentSwiper-button-prev slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="recentSwiper-button-next slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="swiper recentSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($bestSellingProducts as $product)
                        <div class="swiper-slide">
                            <x-products.card :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- recent products section end -->

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            new Swiper(".bannerSwiper", {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".banner-pagination",
                    clickable: false,
                },
                navigation: {
                    nextEl: ".banner-next",
                    prevEl: ".banner-prev",
                },
            });

            new Swiper(".brandSwiper", {
                slidesPerView: 2,
                spaceBetween: 12,
                loop: true,
                mousewheel: true,
                breakpoints: {
                    375: {
                        slidesPerView: 3,
                        spaceBetween: 12,
                    },
                    640: {
                        slidesPerView: 4,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 5,
                        spaceBetween: 18,
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 24,
                    },
                    1500: {
                        slidesPerView: 6,
                        spaceBetween: 24,
                    }
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
                    600: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                    900: {
                        slidesPerView: 3,
                        spaceBetween: 18,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },
                },
            });

            new Swiper(".testimonialSwiper", {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                navigation: {
                    nextEl: ".testimonials-button-next",
                    prevEl: ".testimonials-button-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                },
            });
        </script>
    @endpush
</x-layouts.front>
