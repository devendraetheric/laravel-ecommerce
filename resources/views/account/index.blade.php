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
                                <i data-lucide="shopping-cart" class="size-16 text-primary-600"></i>
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
                                <i data-lucide="map-pin" class="size-16 text-primary-600"></i>

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
                                <i data-lucide="heart" class="size-16 text-primary-600"></i>
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
                                <i data-lucide="user-pen" class="size-16 text-primary-600"></i>
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
