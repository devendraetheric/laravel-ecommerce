@php
    $links = [
        [
            'title' => 'Account Settings',
            'link' => route('account.dashboard'),
            'active' => request()->routeIs('account.dashboard'),
        ],
        [
            'title' => 'Your Orders',
            'link' => route('account.orders.index'),
            'active' => request()->routeIs('account.orders.*'),
        ],
        [
            'title' => 'Your Addresses',
            'link' => route('account.addresses.index'),
            'active' => request()->routeIs('account.addresses.*'),
        ],
        [
            'title' => 'Wishlist',
            'link' => route('account.wishlist'),
            'active' => request()->routeIs('account.wishlist'),
        ],
    ];
@endphp

<!-- user menu start -->
<div class="bg-white">
    <div class="container px-3 md:px-5 xl:px-0">
        <div class="flex flex-col md:flex-row justify-between md:items-center">
            <!-- Tabs -->
            <ul class="inline-flex flex-col md:flex-row w-full">
                @foreach ($links as $link)
                    <li class="p-6 @if ($link['active']) border-b-2 border-primary-600 @endif">
                        <a href="{{ $link['link'] }}"
                            class="text-gray-800 font-medium text-base/6 hover:text-gray-700 opacity-70">{{ $link['title'] }}</a>
                    </li>
                @endforeach
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="p-6">
                @csrf
                <button type="submit"
                    class="cursor-pointer text-red-600 font-medium text-base/6 hover:text-red-700 opacity-70">Logout</button>
            </form>
        </div>
    </div>
</div>
