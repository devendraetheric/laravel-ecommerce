<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => '#', 'text' => 'Your Orders'],
            ],
            'title' => 'Your Orders',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl/6 font-semibold text-gray-800">Your Orders</h3>
                    </div>
                    <div class="p-6">
                        <div class="-mx-6 -my-6 overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="record-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order #</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col" width="40%">Products</th>
                                            <th scope="col" class="!text-center">Status</th>
                                            <th scope="col" class="!text-right">Order Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td class="!font-semibold">
                                                    <a class="link-primary"
                                                        href="{{ route('account.orders.show', $order) }}">{{ $order->order_number }}</a>
                                                </td>

                                                <td>{{ $order->order_date->format('Y-m-d') }}</td>
                                                <td class="!whitespace-normal !break-words">
                                                    {{ $order->items()->count() }}
                                                    {{ $order->items->pluck('product.name')->implode(',') }}
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="inline-flex items-center rounded-md bg-{{ $order->status->color() }}-50 px-2 py-1 text-xs font-medium text-{{ $order->status->color() }}-600 ring-1 ring-{{ $order->status->color() }}-500/10 ring-inset">{{ $order->status->label() }}</span>
                                                </td>
                                                <td class="text-right">${{ $order->grand_total }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Orders Found !!!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
