@php
    $navigation = [
        [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'name' => 'Products',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ],
        [
            'name' => 'Categories',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],
        [
            'name' => 'Brands',
            'route' => route('admin.brands.index'),
            'active' => request()->routeIs('admin.brands.*'),
        ],
        [
            'name' => 'Orders',
            'route' => route('admin.orders.index'),
            'active' => request()->routeIs('admin.orders.*'),
        ],
        [
            'name' => 'Banners',
            'route' => route('admin.banners.index'),
            'active' => request()->routeIs('admin.banners.*'),
        ],
        [
            'name' => 'Settings',
            'route' => route('admin.settings.general'),
            'active' => request()->routeIs('admin.settings.general'),
        ],
        [
            'name' => 'Social Media Links',
            'route' => route('admin.settings.socialMedia'),
            'active' => request()->routeIs('admin.settings.socialMedia'),
        ],
        [
            'name' => 'Company Settings',
            'route' => route('admin.settings.company'),
            'active' => request()->routeIs('admin.settings.company'),
        ],
        [
            'name' => 'Prefix Settings',
            'route' => route('admin.settings.prefix'),
            'active' => request()->routeIs('admin.settings.prefix'),
        ],
    ];
@endphp


<div class="flex h-16 shrink-0 items-center">
    <a href="{{ route('admin.dashboard') }}">
        <img class="h-12 w-auto" src="{{ asset('otc-logo.png') }}" alt="{{ config('app.name') }}" />
    </a>
</div>
<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                @foreach ($navigation as $item)
                    <li>
                        <a href="{{ $item['route'] }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold hover:bg-gray-50 hover:text-primary-600 @if ($item['active']) bg-gray-50 text-primary-600 @else text-gray-700 @endif">
                            <svg class="size-6 shrink-0  @if ($item['active']) text-primary-600 @else text-gray-400 @endif group-hover:text-primary-600"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

    </ul>
</nav>
