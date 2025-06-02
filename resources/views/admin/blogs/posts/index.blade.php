<x-layouts.admin>
    <div class="mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.blogs.posts.index'),
                    'text' => 'Blog Posts',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Blog Posts" :addNewAction="route('admin.blogs.posts.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Bolg-Posts Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>

                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blog_posts as $blog_post)
                                        <tr>
                                            <td class="!font-semibold">{{ $blog_post->title }}</td>
                                            <td>{{ $blog_post->slug }}</td>
                                            <td>{{ $blog_post->blogCategory?->name }}</td>
                                            <td>{{ $blog_post->status }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">
                                                <x-admin.links.edit :href="route('admin.blogs.posts.edit', $blog_post)" />

                                                <x-admin.links.delete :action="route('admin.blogs.posts.destroy', $blog_post)" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {!! $blog_posts->links() !!}
        </div>

    </div>
</x-layouts.admin>
