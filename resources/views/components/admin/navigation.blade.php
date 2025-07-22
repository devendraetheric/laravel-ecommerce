@php
    $navigation = [
        [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => ($active = request()->routeIs('admin.dashboard')),
            'icon' => lucide_icon('house', $active),
        ],
        // Shop group (title only)
        [
            'group' => 'Shop',
        ],
        [
            'name' => 'Products',
            'route' => route('admin.products.index'),
            'active' => ($active = request()->routeIs('admin.products.*')),
            'icon' => lucide_icon('shopping-cart', $active),
        ],
        [
            'name' => 'Categories',
            'route' => route('admin.categories.index'),
            'active' => ($active = request()->routeIs('admin.categories.*')),
            'icon' => lucide_icon('chart-bar-stacked', $active),
        ],
        [
            'name' => 'Brands',
            'route' => route('admin.brands.index'),
            'active' => ($active = request()->routeIs('admin.brands.*')),
            'icon' => lucide_icon('target', $active),
        ],
        [
            'name' => 'Orders',
            'route' => route('admin.orders.index'),
            'active' => ($active = request()->routeIs('admin.orders.*')),
            'icon' => lucide_icon('logs', $active),
        ],
        [
            'name' => 'Coupons',
            'route' => route('admin.coupons.index'),
            'active' => ($active = request()->routeIs('admin.coupons.*')),
            'icon' => lucide_icon('ticket-percent', $active),
        ],
        [
            'name' => 'Banners',
            'route' => route('admin.banners.index'),
            'active' => ($active = request()->routeIs('admin.banners.*')),
            'icon' => lucide_icon('film', $active),
        ],
        [
            'name' => 'Taxes',
            'route' => route('admin.taxes.index'),
            'active' => ($active = request()->routeIs('admin.taxes.*')),
            'icon' => lucide_icon('badge-dollar-sign', $active),
        ],
        [
            'name' => 'Contact Queries',
            'route' => route('admin.contactQueries.index'),
            'active' => ($active = request()->routeIs('admin.contactQueries.*')),
            'icon' => lucide_icon('scroll-text', $active),
        ],
        [
            'name' => 'Subscribers',
            'route' => route('admin.subscribers.index'),
            'active' => ($active = request()->routeIs('admin.subscribers.*')),
            'icon' => lucide_icon('mail-check', $active),
        ],

        // Management group (title only)
        [
            'group' => 'Management',
        ],
        [
            'name' => 'Users',
            'route' => route('admin.users.index'),
            'active' => ($active = request()->routeIs('admin.users.*')),
            'icon' => lucide_icon('users', $active),
        ],
        // Blog group (title only)
        [
            'group' => 'Blog',
        ],
        [
            'name' => 'Posts',
            'route' => route('admin.blogs.posts.index'),
            'active' => ($active = request()->routeIs('admin.blogs.posts.*')),
            'icon' => lucide_icon('rss', $active),
        ],
        [
            'name' => 'Categories',
            'route' => route('admin.blogs.categories.index'),
            'active' => ($active = request()->routeIs('admin.blogs.categories.*')),
            'icon' => lucide_icon('book-plus', $active),
        ],
        // Settings group (title only)
        [
            'group' => 'Settings',
        ],
        [
            'name' => 'General Settings',
            'route' => route('admin.settings.general'),
            'active' => ($active = request()->routeIs('admin.settings.general')),
            'icon' => lucide_icon('settings', $active),
        ],
        [
            'name' => 'Social Media Links',
            'route' => route('admin.settings.socialMedia'),
            'active' => ($active = request()->routeIs('admin.settings.socialMedia')),
            'icon' => lucide_icon('circle-fading-plus', $active),
        ],
        [
            'name' => 'Company Settings',
            'route' => route('admin.settings.company'),
            'active' => ($active = request()->routeIs('admin.settings.company')),
            'icon' => lucide_icon('info', $active),
        ],
        [
            'name' => 'Prefix Settings',
            'route' => route('admin.settings.prefix'),
            'active' => ($active = request()->routeIs('admin.settings.prefix')),
            'icon' => lucide_icon('chevrons-left-right-ellipsis', $active),
        ],
        [
            'name' => 'Payment Gateway',
            'route' => route('admin.settings.paymentGateway'),
            'active' => ($active = request()->routeIs('admin.settings.paymentGateway')),
            'icon' => lucide_icon('credit-card', $active),
        ],
    ];
@endphp


<div class="flex h-16 shrink-0 items-center">
    <a href="{{ route('admin.dashboard') }}">
        <img class="h-12 w-auto" src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}" loading="lazy" />
    </a>
</div>
<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                @foreach ($navigation as $item)
                    @if (isset($item['group']))
                        <div class="uppercase text-xs/6 font-semibold text-gray-400 py-2">{{ $item['group'] }}</div>
                    @else
                        <li>
                            <a href="{{ $item['route'] }}" @class([
                                'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold hover:bg-primary-50 hover:text-primary-600',
                                'bg-primary-50 text-primary-600' => $item['active'],
                                'text-gray-700' => !$item['active'],
                            ])>
                                {!! $item['icon'] !!}
                                <span class="truncate">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>
</nav>
