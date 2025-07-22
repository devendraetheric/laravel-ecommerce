<x-layouts.admin>
    <div class="mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.banners.index'),
                    'text' => 'Banners',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Banners" :addNewAction="route('admin.banners.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Banners Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <th scope="col">Name</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Location</th>
                                    <th scope="col" class="!text-center">Click Count</th>
                                    <th scope="col" class="!text-center">View Count</th>

                                    <th scope="col" class="relative">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($banners as $banner)
                                        <tr>
                                            <td class="!font-semibold">
                                                <div class="flex items-center">
                                                    <div class="size-11 shrink-0">
                                                        <img class="size-11 rounded-md"
                                                            src="{{ $banner?->getMedia($banner->location)->first()?->getUrl() }}"
                                                            alt="{{ $banner->name }}" loading="lazy" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900">{{ $banner->name }}
                                                        </div>
                                                        <div class="mt-1 text-gray-500">{{ $banner->slug }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $banner->link }}</td>
                                            <td>{{ $banner->location }}</td>
                                            <td class="text-center">{{ $banner->click_count }}</td>
                                            <td class="text-center">{{ $banner->view_count }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.banners.edit', $banner)" />

                                                <x-admin.links.delete :action="route('admin.banners.destroy', $banner)" />
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
            {!! $banners->links() !!}
        </div>
    </div>
</x-layouts.admin>
