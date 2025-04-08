<x-layouts.front>
    <!-- Breadcrumb Start -->
    <div class="breadcrumb">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex items-center gap-1 py-1">
                <a href="{{ route('home') }}" class="font-medium leading-tight text-dark-gray">Home</a>

                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <span class="font-medium leading-tight font-display text-gray-black inline-block">Products</span>
            </div>

            <h2 class="pt-[13.5px] text-2xl font-semibold text-gray-black font-display">Products</h2>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- product details section start -->
    <div>
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-10">
                {{-- Left Side --}}

                <div class="gallery-container mb-12">
                    <div class="xl:flex flex-col justify-between hidden">
                        <div class="gallery-button-prev"></div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-01.png" alt="Slide 01">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-02.png" alt="Slide 02">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-03.png" alt="Slide 03">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-04.png" alt="Slide 01">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-02.png" alt="Slide 02">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/assets/images/all-img/f-product-03.png" alt="Slide 03">
                                </div>
                            </div>
                        </div>
                        <div class="gallery-button-next"></div>
                    </div>
                    <div class="swiper-container gallery-main">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-01.png" alt="Slide 01">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-02.png" alt="Slide 01">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-03.png" alt="Slide 01">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-04.png" alt="Slide 01">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-02.png" alt="Slide 01">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/all-img/f-product-03.png" alt="Slide 01">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Right Side --}}
                <div class="xl:px-8 px-0">
                    <h2 class="text-gray-800 pro-title font-semibold mb-3 capitalize">{{ $product->name }}</h2>
                    <div class="flex items-center gap-2.5 mb-6">
                        <p class="flex gap-1.5 items-center">
                            <span class="text-gray-800 text-2xl">${{ $product->selling_price }}</span>
                            <span
                                class="text-gray-800 opacity-30 text-xl line-through">${{ $product->regular_price }}</span>
                        </p>
                        {{-- <span class="bg-[#F5813F] px-2.5 py-1.5 rounded-[4px] text-white text-sm">50% Off</span> --}}
                    </div>
                    <p class="text-gray-700 text-base mb-6">
                        {{ $product->short_description }}
                    </p>
                    <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 mb-6">
                        <div
                            class="border inline-flex justify-around items-center h-[52px] w-[140px] xl:w-[343px] add-to-cart-btn border-[#D6D9DD] rounded-lg">
                            <span
                                class="w-5 h-5 inline-flex justify-center items-center text-[#9A9CAA] pl-[14px] select-none minus"
                                id="minus">-</span>
                            <input type="text" class="text-gray-800 text-base plus_mines_input select-none"
                                value="01" />
                            <span
                                class="w-5 h-5 inline-flex justify-center items-center text-[#9A9CAA] pr-[14px] select-none plus"
                                id="plus">+</span>
                        </div>
                        <div class="flex gap-3 w-full">
                            <div class="xl:w-[343px] add-to-cart-btn">
                                <button
                                    class="inline-flex gap-3 py-3.5 bg-[#029FAE] hover:bg-gray-800 transition-all duration-300 rounded-lg px-4 xl:w-[343px] w-full items-center justify-center">
                                    <span class="text-white text-base">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.75 3.25L4.83 3.61L5.793 15.083C5.82999 15.5345 6.03584 15.9554 6.36948 16.2618C6.70312 16.5682 7.14002 16.7375 7.593 16.736H18.503C18.9367 16.7365 19.3561 16.5803 19.6838 16.2963C20.0116 16.0122 20.2258 15.6194 20.287 15.19L21.237 8.632C21.2623 8.45759 21.253 8.2799 21.2096 8.10909C21.1662 7.93828 21.0896 7.77769 20.9841 7.63653C20.8786 7.49536 20.7463 7.37637 20.5947 7.28637C20.4432 7.19636 20.2754 7.13711 20.101 7.112C20.037 7.105 5.164 7.1 5.164 7.1"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M14.125 10.795H16.898" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.15398 20.203C7.22732 20.1999 7.30053 20.2116 7.36921 20.2375C7.4379 20.2634 7.50063 20.3029 7.55363 20.3537C7.60664 20.4045 7.64881 20.4655 7.67763 20.533C7.70645 20.6005 7.7213 20.6731 7.7213 20.7465C7.7213 20.8199 7.70645 20.8926 7.67763 20.9601C7.64881 21.0276 7.60664 21.0886 7.55363 21.1393C7.50063 21.1901 7.4379 21.2296 7.36921 21.2555C7.30053 21.2814 7.22732 21.2932 7.15398 21.29C7.01387 21.284 6.88149 21.2241 6.78448 21.1228C6.68746 21.0216 6.6333 20.8868 6.6333 20.7465C6.6333 20.6063 6.68746 20.4715 6.78448 20.3702C6.88149 20.2689 7.01387 20.209 7.15398 20.203Z"
                                                fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M18.4351 20.203C18.5797 20.203 18.7183 20.2604 18.8205 20.3626C18.9227 20.4648 18.9801 20.6035 18.9801 20.748C18.9801 20.8925 18.9227 21.0312 18.8205 21.1334C18.7183 21.2356 18.5797 21.293 18.4351 21.293C18.2906 21.293 18.152 21.2356 18.0498 21.1334C17.9476 21.0312 17.8901 20.8925 17.8901 20.748C17.8901 20.6035 17.9476 20.4648 18.0498 20.3626C18.152 20.2604 18.2906 20.203 18.4351 20.203Z"
                                                fill="white" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="text-white text-base">Add To Cart</span>
                                </button>
                            </div>
                            <div>
                                <button
                                    class="h-[52px] w-[52px] border border-[#D6D9DD] rounded-lg inline-flex justify-center items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.87199 11.598C1.79899 8.24799 3.05199 4.419 6.56999 3.286C7.48224 2.9941 8.45106 2.92457 9.39563 3.08322C10.3402 3.24187 11.2332 3.62409 12 4.198C13.455 3.073 15.572 2.693 17.42 3.286C20.937 4.419 22.199 8.24799 21.127 11.598C19.457 16.908 12 20.998 12 20.998C12 20.998 4.59799 16.97 2.87199 11.598V11.598Z"
                                            stroke="#272343" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16 6.70001C16.5232 6.86903 16.9845 7.18931 17.3257 7.62039C17.6669 8.05148 17.8727 8.57403 17.917 9.12201"
                                            stroke="#272343" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="pt-3 text-2xl font-semibold text-gray-black font-display">Product Details</h2>
                <p class="text-gray-700 text-base mb-6">
                    {{ $product->long_description }}
                </p>
            </div>
        </div>
    </div>
    <!-- product details section end -->

</x-layouts.front>
