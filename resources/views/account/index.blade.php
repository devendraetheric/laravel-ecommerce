<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Your Account']],
            'title' => 'Your Account',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)


    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-10">

                    <a href="{{ route('account.orders.index') }}">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="flex gap-4 items-center w-full p-6">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="size-16 text-primary-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <div>
                                    <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Your Orders</h4>
                                    <p class="text-gray-600 opacity-90 text-base leading-tight">Buy things again</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('account.addresses.index') }}">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="flex gap-4 items-center w-full p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-16 text-primary-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>

                                <div>
                                    <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Your Addresses
                                    </h4>
                                    <p class="text-gray-600 opacity-90 text-base leading-tight">Edit Address to Order
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('account.wishlist') }}">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="flex gap-4 items-center w-full p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-16 text-primary-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                                <div>
                                    <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Your Wishlist
                                    </h4>
                                    <p class="text-gray-600 opacity-90 text-base leading-tight">Let's get wishlist to
                                        doorstep
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('profile.edit') }}">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="flex gap-4 items-center w-full p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-16 text-primary-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <div>
                                    <h4 class="text-lg leading-tight text-gray-800 mb-1.5 font-medium">Your Profile
                                    </h4>
                                    <p class="text-gray-600 opacity-90 text-base leading-tight">Edit login name and
                                        mobile number
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
