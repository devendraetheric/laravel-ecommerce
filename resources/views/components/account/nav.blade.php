@php
    $navigation = [
        [
            'name' => 'Dashboard',
            'route' => route('account.dashboard'),
            'active' => ($active = request()->routeIs('account.dashboard')),
            'icon' => lucide_icon('house', $active),
        ],
        [
            'name' => 'Your Orders',
            'route' => route('account.orders.index'),
            'active' => ($active = request()->routeIs('account.orders.*')),
            'icon' => lucide_icon('shopping-cart', $active),
        ],
        [
            'name' => 'Your Addresses',
            'route' => route('account.addresses.index'),
            'active' => ($active = request()->routeIs('account.addresses.*')),
            'icon' => lucide_icon('book-user', $active),
        ],
        [
            'name' => 'Your Wishlist',
            'route' => route('account.wishlist'),
            'active' => ($active = request()->routeIs('account.wishlist')),
            'icon' => lucide_icon('heart', $active),
        ],
        [
            'name' => 'Account Details',
            'route' => route('profile.edit'),
            'active' => ($active = request()->routeIs('profile.edit')),
            'icon' => lucide_icon('user-pen', $active),
        ],
        [
            'name' => 'Change Password',
            'route' => route('profile.password'),
            'active' => ($active = request()->routeIs('profile.password')),
            'icon' => lucide_icon('shield-alert', $active),
        ],
    ];
@endphp

<aside class="flex overflow-x-auto mt-10 lg:block lg:w-64 lg:flex-none">
    <nav class="flex-none bg-white p-4 rounded-xl shadow-xs border border-gray-200">
        <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">
            @foreach ($navigation as $item)
                <li>
                    <a href="{{ $item['route'] }}"
                        class="group flex gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold @if ($item['active']) text-primary-600 bg-gray-50 @else text-gray-700 @endif hover:bg-gray-50 hover:text-primary-600">
                        {!! $item['icon'] !!}
                        {{ $item['name'] }}
                    </a>
                </li>
            @endforeach

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button href="{{ route('account.wishlist') }}"
                        class="group flex w-full cursor-pointer gap-x-3 rounded-md py-2 pr-3 pl-2 text-sm/6 font-semibold text-red-600 hover:bg-gray-50 hover:text-red-600">
                        <i data-lucide="power" class="size-6 shrink-0 text-red-600 group-hover:text-red-600"></i>
                        {{ __('Logout') }}
                    </button>
                </form>
            </li>

        </ul>
    </nav>
</aside>
