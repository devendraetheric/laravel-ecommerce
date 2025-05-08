<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.orders.index'),
                    'text' => 'Orders',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Orders" :addNewAction="route('admin.orders.create')" />

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden ring-1 shadow-sm ring-black/5 sm:rounded-xl">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order #</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="!text-center">Payment Status</th>
                                        <th scope="col">Grand Total</th>


                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td class="!font-semibold">
                                                <a class="link-primary" href="{{ route('admin.orders.show', $order) }}">
                                                    {{ $order->order_number }}
                                                </a>
                                            </td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->order_date->format(setting('general.date_format')) }}</td>
                                            <td>
                                                <span
                                                    class="inline-flex items-center rounded-md bg-{{ $order->status->color() }}-50 px-2 py-1 text-xs font-medium text-{{ $order->status->color() }}-600 ring-1 ring-{{ $order->status->color() }}-500/10 ring-inset">
                                                    {{ $order->status->label() }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-{{ $order->payment_status->color() }}-50 px-2 py-1 text-xs font-medium text-{{ $order->payment_status->color() }}-600 ring-1 ring-{{ $order->payment_status->color() }}-500/10 ring-inset">
                                                    {{ $order->payment_status->label() }}
                                                </span>
                                            </td>
                                            <td>{{ $order->grand_total }}</td>

                                            {{-- Order Status --}}

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <a target="_blank" href="{{ route('admin.orders.pdf', $order) }}"
                                                    class="link-primary relative inline-flex">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                        <path fill-rule="evenodd"
                                                            d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm2.25 8.5a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 3a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </a>

                                                <a href="{{ route('admin.orders.edit', $order) }}"
                                                    class="link-primary relative inline-flex">
                                                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                        <path
                                                            d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                        <path
                                                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.orders.destroy', $order) }}"
                                                    method="post" class="inline-flex"
                                                    onsubmit="return confirm('Are you sure want to delete?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="link-danger relative inline-flex cursor-pointer">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                            <path fill-rule="evenodd"
                                                                d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {!! $orders->links() !!}
        </div>
    </div>
</x-layouts.admin>
