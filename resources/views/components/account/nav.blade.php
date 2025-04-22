<aside class="flex overflow-x-auto mt-6 lg:block lg:w-64 lg:flex-none">
    <nav class="flex-none bg-white p-4 rounded-xl shadow-sm">
        <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
            <li>
                <a href="{{ route('account.dashboard') }}"
                    class="group flex gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold @if (request()->routeIs('account.dashboard')) text-primary-600 bg-gray-50 @else text-gray-700 @endif hover:bg-gray-50 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 shrink-0 @if (request()->routeIs('account.dashboard')) text-primary-600 @else text-gray-700 @endif group-hover:text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Your Account
                </a>
            </li>

            <li>
                <a href="{{ route('account.orders.index') }}"
                    class="group flex gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold @if (request()->routeIs('account.orders.*')) text-primary-600 bg-gray-50 @else text-gray-700 @endif hover:bg-gray-50 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 shrink-0 @if (request()->routeIs('account.orders.*')) text-primary-600 @else text-gray-700 @endif group-hover:text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Your Orders
                </a>
            </li>

            <li>
                <a href="{{ route('account.addresses.index') }}"
                    class="group flex gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold @if (request()->routeIs('account.addresses.*')) text-primary-600 bg-gray-50 @else text-gray-700 @endif hover:bg-gray-50 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 shrink-0 @if (request()->routeIs('account.addresses.*')) text-primary-600 @else text-gray-700 @endif group-hover:text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>
                    Your Addresses
                </a>
            </li>

            <li>
                <a href="{{ route('account.wishlist') }}"
                    class="group flex gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold @if (request()->routeIs('account.wishlist')) text-primary-600 bg-gray-50 @else text-gray-700 @endif hover:bg-gray-50 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 shrink-0 @if (request()->routeIs('account.wishlist')) text-primary-600 @else text-gray-700 @endif group-hover:text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                    Your Wishlist
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button href="{{ route('account.wishlist') }}"
                        class="group flex w-full cursor-pointer gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold text-red-600 hover:bg-gray-50 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 shrink-0 text-red-600 group-hover:text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                        {{ __('Logout') }}
                    </button>
                </form>
            </li>

        </ul>
    </nav>
</aside>
