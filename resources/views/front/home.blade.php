<x-layouts.front>
    <x-slot name="title">
        {{ setting('general.site_name') }} - {{ setting('general.tagline') }}
    </x-slot>
    <x-slot name="description">
        {{ setting('general.site_description') }}
    </x-slot>

    @if ($sliders->isNotEmpty())
        <!-- banner section start -->
        <section class="container px-3 md:px-5 xl:px-0 mt-8 mb-16">
            <div class="swiper bannerSwiper relative z-10">
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
                        <i data-lucide="chevron-left" class="size-5 text-primary-600 group-hover:text-white"></i>
                    </button>
                    <button
                        class="banner-next cursor-pointer group !p-2 flex justify-center items-center border border-solid border-primary-600 !w-12 !h-12 transition-all duration-500 rounded-full !top-2/4 !-translate-y-8 !right-5 hover:bg-primary-600 z-100">
                        <i data-lucide="chevron-right" class="size-5 text-primary-600 group-hover:text-white"></i>
                    </button>
                </div>
                <div class="banner-pagination absolute -bottom-3 flex justify-center z-20"></div>
            </div>
        </section>
        <!-- banner section end -->
    @endif

    @if ($brands->count() > 0)
        <!-- Brand showcase section start -->
        <section class="py-8 bg-accent-50 border-y border-accent-100">
            <div class="container px-3 md:px-5 xl:px-0">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-1">
                            Shop By <span class="text-gradient">Brands</span>
                        </h2>
                        <p class="text-accent-600 text-lg">Premium quality from trusted partners</p>
                    </div>
                    <div class="flex gap-3">
                        <button class="brandSwiper-button-prev slider-nav p-2">
                            <i data-lucide="chevron-left" class="size-4"></i>
                        </button>
                        <button class="brandSwiper-button-next slider-nav p-2">
                            <i data-lucide="chevron-right" class="size-4"></i>
                        </button>
                    </div>
                </div>

                <div class="swiper brandSwiper overflow-hidden py-2">
                    <div class="swiper-wrapper items-center">
                        @foreach ($brands as $brand)
                            <div class="swiper-slide">
                                <a href="{{ route('products.byBrand', $brand) }}" class="block">
                                    <div
                                        class="bg-white border border-accent-100 rounded-lg p-3  hover:border-primary-200 hover:shadow-sm transition-all duration-300 text-center">
                                        <img class="aspect-square size-32 object-contain inline-flex justify-center"
                                            src="{{ $brand->thumbnailURL('thumb') }}" alt="{{ $brand->name }}"
                                            loading="lazy" />

                                        <p>{{ $brand->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Brand showcase section end -->
    @endif

    <!-- feature products section start -->
    <section class="section-padding">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-4">
                <div>
                    <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-3">
                        Featured <span class="text-gradient">Products</span>
                    </h2>
                    <p class="text-accent-600 text-lg">Handpicked favorites just for you</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn-secondary text-sm gap-2">
                    <span>View All</span>
                    <i data-lucide="arrow-right" class="size-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @each('components.products.card', $featuredProducts, 'product')
            </div>
        </div>
    </section>
    <!-- feature products section end -->

    <!-- top categories product section start -->
    <section class="section-padding bg-gradient-to-br from-primary-50 to-accent-50 relative overflow-hidden">
        <!-- Background decoration -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-primary-100/50 to-transparent rounded-full -translate-y-48 translate-x-48">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-accent-100/50 to-transparent rounded-full translate-y-48 -translate-x-48">
        </div>

        <div class="container px-3 md:px-5 xl:px-0 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-4">
                    Our Top <span class="text-gradient">Categories</span>
                </h2>
                <p class="text-accent-600 text-lg max-w-2xl mx-auto">
                    Explore our carefully curated product categories
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @each('components.common.category-card', $topCategories, 'category')
            </div>
        </div>
    </section>
    <!-- top categories product section end -->


    <!-- Our Product section start  -->
    <section class="section-padding">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-4">
                <div>
                    <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-3">
                        Our <span class="text-gradient">Products</span>
                    </h2>
                    <p class="text-accent-600 text-lg">Quality products for every need</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn-secondary text-sm gap-2">
                    <span>View All</span>
                    <i data-lucide="arrow-right" class="size-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @each('components.products.card', $latestProducts, 'product')
            </div>
        </div>
    </section>
    <!-- Our Product section end  -->

    <!-- Testimonials section start -->
    <section class="section-padding bg-gradient-to-br from-accent-50 to-primary-50 relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 border border-primary-200 rounded-full"></div>
            <div class="absolute top-32 right-20 w-24 h-24 border border-primary-200 rounded-full"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 border border-primary-200 rounded-full"></div>
        </div>

        <div class="container px-3 md:px-5 xl:px-0 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
                <div>
                    <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-4">
                        What Our <span class="text-gradient">Clients</span> Say
                    </h2>
                    <p class="text-accent-600 text-lg max-w-2xl">
                        Real stories from our satisfied customers
                    </p>
                </div>
                <div class="flex gap-4">
                    <button class="testimonials-button-prev slider-nav">
                        <i data-lucide="chevron-left" class="size-5"></i>
                    </button>
                    <button class="testimonials-button-next slider-nav">
                        <i data-lucide="chevron-right" class="size-5"></i>
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
    <section class="section-padding">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-6">
                <div>
                    <h2 class="text-accent-900 text-3xl md:text-4xl xl:text-5xl font-bold mb-3">
                        Recently <span class="text-gradient">Added</span>
                    </h2>
                    <p class="text-accent-600 text-lg">Fresh arrivals you don't want to miss</p>
                </div>
                <div class="flex gap-4">
                    <button class="recentSwiper-button-prev slider-nav">
                        <i data-lucide="chevron-left" class="size-5"></i>
                    </button>
                    <button class="recentSwiper-button-next slider-nav">
                        <i data-lucide="chevron-right" class="size-5"></i>
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
        @vite('resources/js/home.js')
    @endpush

</x-layouts.front>
