<x-layouts.admin>

    <div class="mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.coupons.index'),
                    'text' => 'Coupons',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Coupons" :addNewAction="route('admin.coupons.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Coupons Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>

                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $coupon)
                                        <tr>
                                            <td class="!font-semibold">{{ $coupon->code }}</td>
                                            <td>{{ $coupon->type }}</td>
                                            <td>{{ $coupon->value }}</td>
                                            <td>{{ $coupon->start_date->format(setting('general.date_format')) }}</td>
                                            <td>{{ $coupon->end_date->format(setting('general.date_format')) }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.coupons.edit', $coupon)" />

                                                <x-admin.links.delete :action="route('admin.coupons.destroy', $coupon)" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {!! $coupons->links() !!}
        </div>
    </div>
</x-layouts.admin>
