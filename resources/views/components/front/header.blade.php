<!-- header area start -->
<header class="sticky top-0 z-40" x-data="{
    showMenu: false,
    lastScroll: 0,
    visible: true,
    threshold: 15,
    handleScroll() {
        const current = window.pageYOffset;
        const delta = Math.abs(current - this.lastScroll);

        if (delta > this.threshold) {
            // Show header when scrolling up or at top of page
            this.visible = current <= 50;
            this.lastScroll = current;
        }
    }
}" @scroll.window.debounce.50ms="handleScroll" x-cloak>
    <div>
        <div class="bg-slate-800" x-show="visible" x-transition.opacity.duration.300ms>
            <div class="container px-3 md:px-5 xl:px-0">
                <div class="py-3.5 flex justify-center sm:justify-between">
                    <p class="sm:flex gap-2 items-center text-sm leading-tight text-white hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Free shipping on all orders over $50</span>
                    </p>
                    <div>
                        <ul class="flex gap-6 items-center">
                            <li class="inline-flex items-center justify-center">
                                <a href="#"
                                    class="inline-flex gap-2 items-center text-white text-sm leading-tight">Faqs</a>
                            </li>
                            <li class="inline-flex items-center justify-center">
                                <a href="#"
                                    class="!inline-flex gap-2 items-center text-white text-sm leading-tight">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-5">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Need Help</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white border-b border-gray-300 lg:border-gray-100">
            <div class="container px-3 md:px-5 xl:px-0">
                <div class="flex justify-between items-center gap-2 py-4">
                    <div>
                        <a href="{{ route('home') }}">
                            <img class="h-12" src="{{ asset('otc-logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>
                    </div>
                    <div class="lg:max-w-128 lg:block hidden w-full">
                        <div class="grid grid-cols-1">
                            <input type="text" name="account-number" id="account-number"
                                class="col-start-1 row-start-1 block w-full rounded-lg bg-gray-50 py-3 pr-10 pl-6 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:pr-9 sm:text-sm/6"
                                placeholder="search here...">

                            <svg viewBox="0 0 20 20" fill="currentColor"
                                class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="lg:block hidden">
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <a href="{{ route('account.cart') }}" class="relative text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <span
                                    class="absolute -top-2 -right-3 bg-red-400 text-white text-xs rounded-full px-1.5 py-0.5">
                                    {{ cartCount() }}
                                </span>
                            </a>

                            <a href="{{ route('account.wishlist') }}" class="text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </a>
                            @auth
                                <a href="{{ route('account.dashboard') }}" class="text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-primary-600 flex items-center gap-2 border border-primary-600 rounded-lg px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <span class="text-sm">Login</span>
                                </a>
                            @endauth

                        </div>
                    </div>
                    <button type="button"
                        class="lg:hidden inline-block cursor-pointer text-gray-800 hover:text-primary-600"
                        @click="showMenu=true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-header bg-white shadow-xs relative z-30 hidden lg:block">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="py-3.5 flex justify-between items-center">
                <ul class="lg:flex gap-8 items-center hidden">
                    <li>
                        <a class="relative transition-all duration-300 ease-in-out font-medium text-gray-800 leading-tight hover:text-primary-600"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a class="relative transition-all duration-300 ease-in-out font-medium text-gray-800 leading-tight hover:text-primary-600"
                            href="{{ route('products.index') }}">Product</a>
                    </li>
                    <li>
                        <a class="relative transition-all duration-300 ease-in-out font-medium text-gray-800 leading-tight hover:text-primary-600"
                            href="javascript:void(0);">Pages</a>
                    </li>
                    <li>
                        <a class="relative transition-all duration-300 ease-in-out font-medium text-gray-800 leading-tight hover:text-primary-600"
                            href="">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="relative z-500" aria-labelledby="slide-over-title" role="dialog" aria-modal="true"
        x-show="showMenu" x-cloak>
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                    x-transition:enter="transition ease-in-out duration-700 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-700 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="flex justify-between items-center px-3 py-4 mb-4">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('otc-logo.png') }}" alt="{{ config('app.name') }}" />
                                </a>
                                <ul class="flex items-center gap-1">
                                    <li>
                                        <a href="javascript:;"
                                            class="bg-white text-gray-black flex hover:text-primary-600 rounded-lg p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"
                                            class="bg-white text-gray-black flex hover:text-primary-600 rounded-lg p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"
                                            class="bg-white text-gray-black flex hover:text-primary-600 rounded-lg p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:;"
                                            class="bg-white text-gray-black flex hover:text-red-600 focus:text-red-600 rounded-lg p-3 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-hidden"
                                            @click="showMenu = false">
                                            <svg class="size-6" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                                data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="px-3 mb-4">
                                <div class="max-w-128 w-full">
                                    <div class="grid grid-cols-1">
                                        <input type="text" name="account-number" id="account-number"
                                            class="col-start-1 row-start-1 block w-full rounded-lg bg-white py-3 pr-10 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:pr-9 sm:text-sm/6"
                                            placeholder="search here...">

                                        <svg viewBox="0 0 20 20" fill="currentColor"
                                            class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                                            <path fill-rule="evenodd"
                                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <ul class="flex flex-col items-center px-3">
                                <li class="w-full block">
                                    <a href=""
                                        class="block px-3 py-2 text-gray-800 hover:text-primary-600">Home</a>
                                </li>
                                <li class="w-full block">
                                    <a href=""
                                        class="block px-3 py-2 text-gray-800 hover:text-primary-600">Shop</a>
                                </li>
                                <li class="w-full block">
                                    <a href=""
                                        class="block px-3 py-2 text-gray-800 hover:text-primary-600">Product</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
