<x-layouts.admin>

    <div class="mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.subscribers.index'),
                    'text' => 'Subscribers',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Subscribers" :addNewAction="route('admin.subscribers.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Subscribers Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subscribers as $subscriber)
                                        <tr>
                                            <td class="!font-semibold">{{ $subscriber->name }}</td>
                                            <td>{{ $subscriber->email }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.subscribers.edit', $subscriber)" />

                                                <x-admin.links.delete :action="route('admin.subscribers.destroy', $subscriber)" />
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
            {!! $subscribers->links() !!}
        </div>

</x-layouts.admin>
