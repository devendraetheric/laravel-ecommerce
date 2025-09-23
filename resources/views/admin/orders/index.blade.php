<x-layouts.admin>
    <div class="mx-auto">
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

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Orders" {{-- :addNewAction="route('admin.orders.create')" --}} />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Orders Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order</th>
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
                                            <td>@money($order->grand_total)</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">

                                                <a target="_blank" href="{{ route('admin.orders.pdf', $order) }}"
                                                    class="link-primary relative inline-flex">
                                                    <i data-lucide="file-text" class="size-5"></i>
                                                </a>

                                                {{-- <x-admin.links.edit :href="route('admin.orders.edit', $order)" /> --}}

                                                <x-admin.links.delete :action="route('admin.orders.destroy', $order)" />
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
            {!! $orders->links() !!}
        </div>
    </div>
</x-layouts.admin>
