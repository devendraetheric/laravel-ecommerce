@php

    $links = [
        ['link' => route('home'), 'title' => 'Home'],
        ['link' => route('products.index'), 'title' => 'Products'],
        ['link' => '#', 'title' => 'About Us'],
        ['link' => '#', 'title' => 'Contact Us'],
    ];
@endphp

<!-- header area start -->
<header class="sticky top-0 z-40">
    <div class="bg-white border-b border-gray-300 lg:border-gray-100">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center gap-2 py-4">
                <div>
                    <a href="{{ route('home') }}">
                        <img class="h-12" src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}"
                            loading="lazy" />
                    </a>
                </div>
                <div class="lg:max-w-64 lg:block hidden w-full" @click="openSearch = true">
                    <div class="grid grid-cols-1">
                        <input type="text" x-ref="searchInput"
                            class="col-start-1 row-start-1 h-12 w-full pr-4 pl-11 rounded-xl text-base bg-gray-50 border border-gray-300 text-gray-900 outline-hidden placeholder:text-gray-400 sm:text-sm"
                            placeholder="Search here..." role="combobox" aria-expanded="false" aria-controls="options"
                            readonly>
                        <svg class="pointer-events-none col-start-1 row-start-1 ml-4 size-5 self-center text-gray-400"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
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

                        <a href="{{ route('account.wishlist') }}" class="text-gray-700" aria-label="Wishlist">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </a>
                        @auth
                            <a href="{{ route('account.dashboard') }}" class="text-gray-700" aria-label="Your Account">
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
                <div class="lg:hidden inline-flex space-x-4">
                    <button type="button" class="cursor-pointer text-gray-800 hover:text-primary-600"
                        @click="openSearch=true" aria-label="Open search box">

                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>


                    <a href="{{ route('account.cart') }}" class="relative text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span class="absolute -top-2 -right-3 bg-red-400 text-white text-xs rounded-full px-1.5 py-0.5">
                            {{ cartCount() }}
                        </span>
                    </a>

                    <a href="{{ route('account.wishlist') }}" class="text-gray-700" aria-label="Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </a>

                    <button type="button" class="cursor-pointer text-gray-800 hover:text-primary-600"
                        @click="showMenu=true" aria-label="Show Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
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
                    @foreach ($links as $link)
                        <li>
                            <a class="relative font-medium text-gray-800 leading-tight hover:text-primary-600"
                                href="{{ $link['link'] }}">{{ $link['title'] }}</a>
                        </li>
                    @endforeach
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
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    x-show="showMenu" x-cloak>

                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="flex justify-between items-center px-3 py-4 mb-4">
                                <a href="{{ route('home') }}">
                                    <img src="{{ getLogoURL() }}" alt="{{ asset('otc-logo.png') }}"
                                        loading="lazy" />
                                </a>

                                <button
                                    class="bg-white text-gray-black flex hover:text-orange-600 focus:text-orange-600 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:outline-hidden"
                                    @click="showMenu = false">
                                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <ul class="flex flex-col items-center px-3">
                                @foreach ($links as $link)
                                    <li class="w-full block">
                                        <a class="block px-3 py-2 rounded-md text-gray-800 hover:text-primary-600 hover:bg-gray-50"
                                            href="{{ $link['link'] }}">{{ $link['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-common.search-product />
</header>
<!-- header area end -->
