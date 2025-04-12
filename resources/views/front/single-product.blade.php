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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-10">
                {{-- Left Side --}}

                <!-- Image gallery -->
                <div class="flex flex-col-reverse">
                    <!-- Image selector -->
                    <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                        <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                            <button id="tabs-1-tab-1"
                                class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium text-gray-900 uppercase hover:bg-gray-50 focus:ring-3 focus:ring-primary-500/50 focus:ring-offset-4 focus:outline-hidden"
                                aria-controls="tabs-1-panel-1" role="tab" type="button">
                                <span class="sr-only">Angled view</span>
                                <span class="absolute inset-0 overflow-hidden rounded-md">
                                    <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product->name }}"
                                        class="size-full object-cover">
                                </span>
                                <!-- Selected: "ring-primary-500", Not Selected: "ring-transparent" -->
                                <span
                                    class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-transparent ring-offset-2"
                                    aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <!-- Tab panel, show/hide based on tab state. -->
                        <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                            <img src="{{ $product->thumbnailURL() }}" alt="{{ $product->name }}"
                                class="w-full max-h-2/6 object-cover sm:rounded-lg">
                        </div>
                    </div>
                </div>
                {{-- Right Side --}}
                <div class="xl:px-8 px-0">
                    <h2 class="text-gray-800 text-3xl font-semibold mb-3 capitalize">{{ $product->name }}</h2>
                    <div class="flex items-center gap-2.5 mb-6">
                        <p class="flex gap-4 items-center">
                            <span class="text-gray-800 text-3xl">${{ $product->selling_price }}</span>
                            <span
                                class="text-red-600 opacity-70 text-3xl line-through">${{ $product->regular_price }}</span>
                        </p>
                        {{-- <span class="bg-[#F5813F] px-2.5 py-1.5 rounded-[4px] text-white text-sm">50% Off</span> --}}
                    </div>
                    <p class="text-gray-700 text-base mb-6">
                        {{ $product->short_description }}
                    </p>
                    <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 mb-6">
                        <input type="number" name="quantity" id="quantity"
                            class="block w-24 rounded-md bg-white px-3 py-3.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6"
                            value="1" min="1" required />
                        <button
                            class="inline-flex items-center gap-2 bg-primary-600 border rounded-md leading-tight text-white font-bold px-4 py-3.5 hover:bg-primary-500 outline-none">
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
                                        fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="text-white text-base">Add To Cart</span>
                        </button>
                        <a href=""
                            class="inline-flex items-center rounded-lg bg-white px-4 py-3.5 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-primary-300 hover:bg-primary-50 gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>

                            <span class="hidden md:inline-flex">Add to Wishlist</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="my-10">
                <h2 class="pt-3 text-2xl font-semibold text-gray-black font-display">Product Details</h2>
                <p class="text-gray-700 text-base mb-6">
                    {{ $product->long_description }}
                </p>
            </div>
        </div>
    </div>
    <!-- product details section end -->

</x-layouts.front>
