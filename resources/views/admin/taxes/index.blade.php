<x-layouts.admin>
    <div class="mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.taxes.index'),
                    'text' => 'Taxes',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Taxes" :addNewAction="route('admin.taxes.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Taxes Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Rate</th>

                                    <th scope="col" class="relative">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($taxes as $tax)
                                        <tr>
                                            <td class="!font-semibold">{{ $tax->name }}</td>
                                            <td>{{ $tax->type }}</td>
                                            <td>{{ $tax->rate }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.taxes.edit', $tax)" />

                                                <x-admin.links.delete :action="route('admin.taxes.destroy', $tax)" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {!! $taxes->links() !!}
        </div>
    </div>
</x-layouts.admin>
