<x-layouts.admin>
    <div class="mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.categories.index'),
                    'text' => 'Categories',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Categories" :addNewAction="route('admin.categories.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Category Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Products</th>

                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td class="!font-semibold">{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->products_count }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.categories.edit', $category)" />

                                                <x-admin.links.delete :action="route('admin.categories.destroy', $category)" />
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
            {!! $categories->links() !!}
        </div>
    </div>
</x-layouts.admin>
