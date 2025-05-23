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
                <div>
                    <a href="{{ route('products.index') }}"
                        class="text-base/6 text-primary-600 hover:text-primary-700">View
                        All</a>
                </div>
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
                <div class="flex gap-4">
                    <button class="categoriesSwiper-button-prev slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="categoriesSwiper-button-next slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="swiper topCategoriesSwiper mx-3 md:mx-0">
                <div class="swiper-wrapper">
                    @foreach ($topCategories as $category)
                        <div class="swiper-slide border border-gray-100 rounded-xl">
                            <div class="group overflow-hidden rounded-lg">
                                <div class="w-full">
                                    <a href="{{ route('products.byCategory', $category) }}">
                                        <img class="w-full object-cover transition duration-500 ease-out delay-0 group-hover:scale-110"
                                            src="{{ $category?->thumbnailURL() }}" alt="{{ $category->name }}"
                                            loading="lazy" />
                                    </a>
                                </div>

                                <div
                                    class="bg-gray-900 opacity-70 p-5 absolute bottom-0 w-full rounded-b-lg text-white">
                                    <h3 class="font-normal text-2xl leading-tight mb-2">
                                        <a
                                            href="{{ route('products.byCategory', $category) }}">{{ $category->name }}</a>
                                    </h3>
                                    <p class="text-sm leading-tight">{{ $category->products_count }} Products</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
                <div>
                    <a href="{{ route('products.index') }}"
                        class="text-base/6 text-primary-600 hover:text-primary-700">View
                        All</a>
                </div>
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="testimonials-button-next slider-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="swiper testimonialSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <x-common.testimonial-card />
                    </div>
                    <div class="swiper-slide">
                        <x-common.testimonial-card />
                    </div>
                    <div class="swiper-slide">
                        <x-common.testimonial-card />
                    </div>
                    <div class="swiper-slide">
                        <x-common.testimonial-card />
                    </div>
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

    <section class="container px-3 md:px-5 xl:px-0">
        <div class="bg-white shadow-xs rounded-xl border border-gray-100 xl:py-12 xl:px-18 p-8 mb-6">
            <div class="grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-4 sm:grid-cols-2 gap-6">
                <div class="flex gap-4 items-center w-full">
                    <div>
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_248_4580)">
                                <path
                                    d="M44.1788 10.1498L23.293 0.0669785C23.1078 -0.0223262 22.8922 -0.0223262 22.7071 0.0669785L1.82125 10.1498C1.58837 10.2622 1.4404 10.498 1.4404 10.7566V35.2434C1.4404 35.502 1.58837 35.7378 1.82125 35.8502L22.707 45.933C22.7996 45.9777 22.8999 46 23 46C23.1002 46 23.2004 45.9777 23.293 45.933L44.1788 35.8502C44.4117 35.7378 44.5597 35.502 44.5597 35.2434V10.7567C44.5597 10.4979 44.4116 10.2623 44.1788 10.1498ZM23 1.42209L42.3359 10.7566L36.7308 13.4625C36.6954 13.4355 36.6579 13.4105 36.6167 13.3906L17.4122 4.11965L23 1.42209ZM15.8904 4.88153L35.1982 14.2025L31.2437 16.1115L11.9439 6.79439L15.8904 4.88153ZM35.6499 15.4808V22.5376L31.9562 24.3208V17.264L35.6499 15.4808ZM43.212 34.8206L23.6739 44.2526V21.2623L28.3343 19.0124C28.6694 18.8506 28.8099 18.4478 28.6481 18.1126C28.4863 17.7776 28.0836 17.6369 27.7484 17.7988L23 20.0912L21.1316 19.1891C20.7964 19.0272 20.3937 19.1679 20.2318 19.503C20.07 19.8381 20.2106 20.2409 20.5457 20.4028L22.3262 21.2623V44.2526L2.78806 34.8204V11.8301L17.6662 19.0127C17.7606 19.0583 17.8604 19.0799 17.9586 19.0799C18.2091 19.0799 18.4497 18.9396 18.5659 18.6989C18.7277 18.3637 18.5872 17.9609 18.2521 17.7991L3.66412 10.7566L10.3579 7.52509L30.5992 17.2968C30.6022 17.3009 30.6055 17.3046 30.6085 17.3086V25.3945C30.6085 25.6264 30.7278 25.8419 30.9242 25.9652C31.0332 26.0337 31.1577 26.0683 31.2825 26.0683C31.3824 26.0683 31.4825 26.0461 31.5753 26.0013L36.6167 23.5675C36.8496 23.4551 36.9976 23.2194 36.9976 22.9607V14.8303L43.212 11.8302V34.8206Z"
                                    fill="#272343" />
                                <path
                                    d="M8.34876 32.207L5.28374 30.7274C4.94844 30.5654 4.54576 30.7061 4.38395 31.0412C4.22214 31.3764 4.36266 31.7792 4.69778 31.941L7.7628 33.4206C7.85722 33.4663 7.95704 33.4879 8.05524 33.4879C8.30572 33.4879 8.54633 33.3475 8.66249 33.1068C8.82439 32.7716 8.68388 32.3689 8.34876 32.207Z"
                                    fill="#272343" />
                                <path
                                    d="M11.1696 30.371L5.28798 27.5315C4.95278 27.3697 4.55001 27.5102 4.3882 27.8454C4.22648 28.1806 4.367 28.5834 4.70211 28.7452L10.5837 31.5847C10.6782 31.6302 10.778 31.6519 10.8762 31.6519C11.1267 31.6519 11.3673 31.5115 11.4834 31.2708C11.6452 30.9355 11.5047 30.5327 11.1696 30.371Z"
                                    fill="#272343" />
                            </g>
                            <defs>
                                <clipPath id="clip0_248_4580">
                                    <rect width="46" height="46" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Discount</h4>
                        <p class="text-gray-600 opacity-90 text-base leading-tight">Every week new sales</p>
                    </div>
                </div>
                <div class="flex gap-4 items-center w-full">
                    <div>
                        <svg width="64" height="39" viewBox="0 0 64 39" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.9635 30.5869C12.894 30.5869 12.024 31.4569 12.024 32.5264C12.024 33.5959 12.894 34.4659 13.9635 34.4659C15.033 34.4659 15.903 33.5959 15.903 32.5264C15.903 31.4569 15.033 30.5869 13.9635 30.5869Z"
                                fill="#272343" />
                            <path
                                d="M54.0446 30.5869C52.9751 30.5869 52.1051 31.4569 52.1051 32.5264C52.1051 33.5959 52.9751 34.4659 54.0446 34.4659C55.1141 34.4659 55.9841 33.5959 55.9841 32.5264C55.9841 31.4569 55.1141 30.5869 54.0446 30.5869Z"
                                fill="#272343" />
                            <path
                                d="M61.9886 18.1537L54.7706 15.7477L51.397 6.4705C50.9759 5.31237 49.865 4.53425 48.6326 4.53425H39.9516V2.46562C39.9516 1.39612 39.0816 0.526123 38.0121 0.526123H1.9395C0.87 0.526123 0 1.39625 0 2.46575V29.5202C0 30.5897 0.87 31.4597 1.9395 31.4597H8.11375C8.05075 31.806 8.01612 32.1621 8.01612 32.5262C8.01612 35.8057 10.6842 38.4739 13.9637 38.4739C17.2432 38.4739 19.9114 35.8057 19.9114 32.5262C19.9114 32.162 19.8767 31.806 19.8137 31.4597H48.1946C48.1316 31.806 48.097 32.1621 48.097 32.5262C48.097 35.8057 50.7651 38.4739 54.0446 38.4739C57.3241 38.4739 59.9922 35.8057 59.9922 32.5262C59.9922 32.063 59.9372 31.6125 59.8366 31.1795L61.8205 30.1876C63.1647 29.5152 64 28.1636 64 26.6602V20.9444C64 19.6764 63.1917 18.5549 61.9886 18.1537ZM1.875 2.46575C1.875 2.43012 1.90387 2.40112 1.9395 2.40112H38.0121C38.0477 2.40112 38.0766 2.43 38.0766 2.46562V22.5705H1.875V2.46575ZM13.9636 36.5989C11.718 36.5989 9.891 34.7719 9.891 32.5262C9.891 30.2806 11.718 28.4536 13.9636 28.4536C16.2092 28.4536 18.0362 30.2806 18.0362 32.5262C18.0364 34.7719 16.2094 36.5989 13.9636 36.5989ZM38.0766 29.5846H19.1297C18.1044 27.791 16.1735 26.5786 13.9636 26.5786C11.7537 26.5786 9.823 27.791 8.79762 29.5846H1.9395C1.90387 29.5846 1.875 29.5557 1.875 29.5201V24.4455H38.0766V29.5846ZM50.8372 10.4174L52.706 15.5565H50.693L48.8242 10.4174H50.8372ZM39.9516 6.40925H48.6326C49.0795 6.40925 49.4823 6.69137 49.635 7.11125L50.1554 8.54225H39.9516V6.40925ZM39.9516 10.4174H46.8291L48.6979 15.5565H39.9516V10.4174ZM54.0444 36.5989C51.7988 36.5989 49.9717 34.7719 49.9717 32.5262C49.9717 30.2806 51.7988 28.4536 54.0444 28.4536C56.29 28.4536 58.117 30.2806 58.117 32.5262C58.117 34.7719 56.29 36.5989 54.0444 36.5989ZM62.125 22.5704H61.0585C60.5407 22.5704 60.121 22.9901 60.121 23.5079C60.121 24.0256 60.5407 24.4454 61.0585 24.4454H62.125V26.6601C62.125 27.4489 61.6869 28.1577 60.9816 28.5105L59.1258 29.4384C58.0808 27.725 56.194 26.5786 54.0444 26.5786C51.8345 26.5786 49.9038 27.791 48.8784 29.5846H39.9516V24.4455H57.0505C57.5682 24.4455 57.988 24.0257 57.988 23.508C57.988 22.9902 57.5682 22.5705 57.0505 22.5705H39.9516V17.4314H53.8923L61.3957 19.9325C61.832 20.0779 62.125 20.4845 62.125 20.9442V22.5704Z"
                                fill="#272343" />
                            <path
                                d="M31.4632 11.6718L24.4491 7.66382C23.9997 7.40695 23.427 7.5632 23.17 8.0127C22.9131 8.46232 23.0692 9.03495 23.5189 9.29182L27.4679 11.5484H8.95374C8.43599 11.5484 8.01624 11.9682 8.01624 12.4859C8.01624 13.0037 8.43599 13.4233 8.95374 13.4233H27.4679L23.5189 15.6799C23.0694 15.9368 22.9131 16.5094 23.17 16.9591C23.343 17.2618 23.6594 17.4316 23.9849 17.4316C24.1426 17.4316 24.3025 17.3917 24.4491 17.3078L31.4632 13.2998C31.7552 13.1329 31.9356 12.8223 31.9356 12.4858C31.9356 12.1493 31.7554 11.8388 31.4632 11.6718Z"
                                fill="#272343" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Free Delivary</h4>
                        <p class="text-gray-600 opacity-90 text-base leading-tight">100% Free for all orders</p>
                    </div>
                </div>
                <div class="flex gap-4 items-center w-full">
                    <div>
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_248_4611)">
                                <path
                                    d="M47.5937 14.2852C47.4201 13.9197 46.9829 13.7643 46.6179 13.9379C46.2525 14.1114 46.097 14.5483 46.2705 14.9138C47.7733 18.077 48.5352 21.4705 48.5352 25.0001C48.5352 31.2866 46.0871 37.1968 41.6419 41.642C37.1968 46.0872 31.2865 48.5353 25 48.5353C21.2718 48.5353 17.7063 47.6892 14.403 46.0205C11.6506 44.6301 9.16396 42.678 7.14482 40.3323L10.0346 41.2956C10.4183 41.4235 10.8331 41.2161 10.961 40.8323C11.089 40.4485 10.8815 40.0338 10.4977 39.9059L5.29755 38.1725C5.05673 38.0923 4.7915 38.1423 4.59667 38.305C4.40185 38.4677 4.30507 38.7196 4.34091 38.9709L5.20761 45.0378C5.25985 45.4031 5.57314 45.6667 5.93183 45.6667C5.9663 45.6667 6.00116 45.6643 6.03632 45.6593C6.43681 45.602 6.71503 45.2311 6.65781 44.8307L6.17421 41.4456C8.29326 43.8655 10.8819 45.8829 13.7427 47.328C17.2526 49.1011 21.0401 50.0001 25 50.0001C31.6777 50.0001 37.9559 47.3996 42.6777 42.6778C47.3995 37.9559 50 31.6778 50 25.0001C50 21.2514 49.1904 17.6464 47.5937 14.2852Z"
                                    fill="#272343" />
                                <path
                                    d="M45.6592 11.0293L44.7925 4.9624C44.7353 4.56191 44.3634 4.28389 43.9639 4.34092C43.5634 4.39814 43.2852 4.76914 43.3424 5.16953L43.8255 8.55117C39.0691 3.10156 32.2791 0 25 0C18.3223 0 12.0442 2.60049 7.32227 7.32227C2.60049 12.0442 0 18.3223 0 25C0 28.7488 0.809668 32.3539 2.40635 35.7149C2.53174 35.9789 2.79443 36.1333 3.06846 36.1333C3.17373 36.1333 3.28076 36.1105 3.38223 36.0622C3.74756 35.8887 3.90303 35.4518 3.72949 35.0863C2.22676 31.9233 1.46484 28.5298 1.46484 25C1.46484 18.7135 3.91289 12.8033 8.35811 8.35811C12.8033 3.91289 18.7135 1.46484 25 1.46484C31.9195 1.46484 38.3694 4.44277 42.8531 9.66709L39.9655 8.70459C39.5815 8.57646 39.1669 8.78408 39.0391 9.16787C38.9112 9.55166 39.1185 9.96641 39.5022 10.0943L44.7024 11.8277C44.7782 11.8529 44.8563 11.8653 44.934 11.8653C45.1031 11.8653 45.2697 11.8067 45.4034 11.6952C45.5982 11.5325 45.695 11.2806 45.6592 11.0293Z"
                                    fill="#272343" />
                                <path
                                    d="M22.9646 32.8787H15.597C15.8912 30.3152 17.7128 28.5953 19.6318 26.7833C21.6304 24.8962 23.697 22.9449 23.697 20.0146C23.697 17.6116 21.5423 15.6565 18.8939 15.6565C16.2454 15.6565 14.0908 17.6116 14.0908 20.0146C14.0908 20.4191 14.4187 20.747 14.8232 20.747C15.2277 20.747 15.5556 20.4191 15.5556 20.0146C15.5556 18.4193 17.0531 17.1213 18.8939 17.1213C20.7347 17.1213 22.2322 18.4193 22.2322 20.0146C22.2322 22.3134 20.4805 23.9673 18.6261 25.7183C16.5002 27.7255 14.0908 30.0006 14.0908 33.6111C14.0908 34.0156 14.4187 34.3435 14.8232 34.3435H22.9646C23.3691 34.3435 23.697 34.0156 23.697 33.6111C23.697 33.2066 23.3691 32.8787 22.9646 32.8787Z"
                                    fill="#272343" />
                                <path
                                    d="M35.1767 28.1816H34.3435V16.3889C34.3435 15.9844 34.0157 15.6565 33.6111 15.6565C33.2065 15.6565 32.8787 15.9844 32.8787 16.3889V28.1817H26.6654L28.8511 16.524C28.9257 16.1264 28.6638 15.7436 28.2662 15.6691C27.8691 15.595 27.4861 15.8564 27.4115 16.254L25.063 28.7792C25.0229 28.9933 25.0801 29.2142 25.2193 29.3819C25.3584 29.5496 25.565 29.6465 25.7828 29.6465H32.8787V33.6111C32.8787 34.0155 33.2065 34.3434 33.6111 34.3434C34.0157 34.3434 34.3435 34.0155 34.3435 33.611V29.6464H35.1767C35.5813 29.6464 35.9091 29.3185 35.9091 28.914C35.9091 28.5095 35.5813 28.1816 35.1767 28.1816Z"
                                    fill="#272343" />
                                <path
                                    d="M25 3.91406C24.5955 3.91406 24.2676 4.24199 24.2676 4.64648V7.77773C24.2676 8.18223 24.5955 8.51016 25 8.51016C25.4046 8.51016 25.7324 8.18223 25.7324 7.77773V4.64648C25.7324 4.24199 25.4046 3.91406 25 3.91406Z"
                                    fill="#272343" />
                                <path
                                    d="M25 41.4897C24.5955 41.4897 24.2676 41.8177 24.2676 42.2222V45.3534C24.2676 45.7579 24.5955 46.0858 25 46.0858C25.4046 46.0858 25.7324 45.7579 25.7324 45.3534V42.2222C25.7324 41.8177 25.4046 41.4897 25 41.4897Z"
                                    fill="#272343" />
                                <path
                                    d="M45.3533 24.2676H42.222C41.8175 24.2676 41.4896 24.5955 41.4896 25C41.4896 25.4045 41.8175 25.7324 42.222 25.7324H45.3533C45.7579 25.7324 46.0857 25.4045 46.0857 25C46.0857 24.5955 45.7579 24.2676 45.3533 24.2676Z"
                                    fill="#272343" />
                                <path
                                    d="M7.77779 24.2676H4.64655C4.24205 24.2676 3.91412 24.5955 3.91412 25C3.91412 25.4045 4.24205 25.7324 4.64655 25.7324H7.77779C8.18229 25.7324 8.51022 25.4045 8.51022 25C8.51022 24.5955 8.18229 24.2676 7.77779 24.2676Z"
                                    fill="#272343" />
                            </g>
                            <defs>
                                <clipPath id="clip0_248_4611">
                                    <rect width="50" height="50" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Great Support 24/7
                        </h4>
                        <p class="text-gray-600 opacity-90 text-base leading-tight">We care your experiences</p>
                    </div>
                </div>
                <div class="flex gap-4 items-center w-full">
                    <div>
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_248_4640)">
                                <path
                                    d="M49.2188 6.95611C49.2017 6.63932 48.9825 6.36949 48.6759 6.28785L25.1704 0.0246826C25.0466 -0.00822752 24.9166 -0.00822752 24.7929 0.0246826L1.32403 6.28795C1.01798 6.36969 0.799031 6.63883 0.781453 6.95514C0.765144 7.24811 0.414461 14.2331 3.16123 23.0639C4.77559 28.2539 7.13222 32.9926 10.1658 37.1484C13.9605 42.3471 18.8277 46.6391 24.632 49.9058C24.7434 49.9685 24.8672 50 24.9912 50C25.1091 50 25.2272 49.9715 25.3347 49.9144C31.1488 46.8262 36.0241 42.643 39.8249 37.481C42.8619 33.3563 45.2212 28.6037 46.8372 23.3552C49.5855 14.4291 49.2351 7.25719 49.2188 6.95611ZM45.4219 22.9736C43.8516 28.0558 41.5654 32.6529 38.6267 36.6376C35.1991 41.2852 30.8648 45.1106 25.7327 48.0236V44.2556C32.3859 40.0553 37.4036 34.1094 40.6473 26.5751C43.3181 20.3717 44.1884 14.4831 44.4482 10.6354C44.4718 10.2858 44.2446 9.96841 43.9059 9.87828L42.4122 9.48033C42.0215 9.37623 41.62 9.60855 41.5159 9.99957C41.4117 10.3904 41.6441 10.7918 42.0351 10.896L42.942 11.1376C42.6415 14.8677 41.7552 20.2971 39.3017 25.9958C36.1947 33.2129 31.4039 38.9148 25.0581 42.9508C24.4211 42.5296 23.7946 42.09 23.191 41.6406C22.8667 41.399 22.4077 41.4661 22.166 41.7906C21.9244 42.115 21.9915 42.574 22.316 42.8156C22.9467 43.2853 23.6019 43.7433 24.2675 44.1828V47.9997C19.1331 44.9282 14.7976 41.0013 11.3689 36.3118C8.43114 32.2938 6.1458 27.7075 4.57627 22.6806C2.31719 15.4447 2.20674 9.34488 2.23018 7.56236L24.2675 1.68112V5.02672L6.10468 9.87398C5.76523 9.96461 5.53789 10.2835 5.56289 10.6339C5.75205 13.281 6.28447 17.3995 7.74726 21.9882C10.1655 29.5743 14.227 35.9031 19.8189 40.7989C19.9579 40.9206 20.1299 40.9803 20.3012 40.9803C20.505 40.9803 20.7078 40.8957 20.8527 40.7303C21.1192 40.4259 21.0884 39.9631 20.7841 39.6967C15.3958 34.9793 11.4792 28.8716 9.14306 21.5434C7.83076 17.4267 7.29033 13.7003 7.07148 11.1325L24.9829 6.35241L38.8691 10.0525C39.26 10.1565 39.6614 9.92427 39.7655 9.53326C39.8696 9.14244 39.6372 8.74097 39.2462 8.63687L25.7326 5.036V1.6906L47.7697 7.56266C47.794 9.37564 47.6883 15.6388 45.4219 22.9736Z"
                                    fill="#272343" />
                                <path
                                    d="M36.0205 17.1149C35.5866 16.6803 35.0093 16.4412 34.3951 16.4412C33.7807 16.4412 33.2035 16.6803 32.77 17.1145L23.4343 26.4497L18.3377 21.3535C17.904 20.9191 17.3266 20.6798 16.7124 20.6798C16.098 20.6798 15.5209 20.919 15.0875 21.353C14.6533 21.7871 14.4139 22.3642 14.4139 22.9783C14.4139 23.5923 14.6531 24.1694 15.0873 24.6033L21.8089 31.3249C22.2427 31.7593 22.8199 31.9986 23.4342 31.9986C24.0486 31.9986 24.6257 31.7594 25.0593 31.3252L36.0199 20.3647C36.4541 19.9308 36.6934 19.3536 36.6934 18.7395C36.6934 18.1254 36.4542 17.5483 36.0205 17.1149ZM34.9841 19.3286L24.0231 30.2896C23.8661 30.4468 23.657 30.5334 23.4342 30.5334C23.2115 30.5334 23.0024 30.4468 22.8451 30.2893L16.123 23.5671C15.9657 23.4099 15.879 23.2008 15.879 22.9782C15.879 22.7555 15.9657 22.5465 16.1235 22.3886C16.2805 22.2314 16.4897 22.1448 16.7124 22.1448C16.9349 22.1448 17.144 22.2314 17.3015 22.3889L22.9165 28.0034C23.2025 28.2895 23.6664 28.2894 23.9523 28.0034L33.8063 18.1499C33.9633 17.9926 34.1725 17.906 34.3952 17.906C34.6178 17.906 34.8268 17.9926 34.9844 18.1503C35.1417 18.3076 35.2285 18.5167 35.2285 18.7393C35.2285 18.9619 35.1417 19.1711 34.9841 19.3286Z"
                                    fill="#272343" />
                            </g>
                            <defs>
                                <clipPath id="clip0_248_4640">
                                    <rect width="50" height="50" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">secure Payment</h4>
                        <p class="text-gray-600 opacity-90 text-base leading-tight">100% Secure Payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

            new Swiper(".topCategoriesSwiper", {
                loop: true,
                slidesPerView: 2,
                spaceBetween: 12,
                centeredSlides: true,
                slideToClickedSlide: true,
                navigation: {
                    nextEl: ".categoriesSwiper-button-next",
                    prevEl: ".categoriesSwiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 18,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                }
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
