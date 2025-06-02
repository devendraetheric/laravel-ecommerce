<x-layouts.admin>
    <div class="mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.blogs.categories.index'),
                    'text' => 'Blog Categories',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Blog Categories" :addNewAction="route('admin.blogs.categories.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Blog-Categories Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Blogs</th>

                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blog_categories as $blog_category)
                                        <tr>
                                            <td class="!font-semibold">{{ $blog_category->name }}</td>
                                            <td>{{ $blog_category->slug }}</td>
                                            <td>{{ $blog_category->posts_count }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.categories.edit', $blog_category)" />

                                                <x-admin.links.delete :action="route('admin.categories.destroy', $blog_category)" />
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
            {!! $blog_categories->links() !!}
        </div>
    </div>
</x-layouts.admin>
