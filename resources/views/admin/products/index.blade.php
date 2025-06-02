<x-layouts.admin>
    <div class="mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.products.index'),
                    'text' => 'Products',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Products" :addNewAction="route('admin.products.create')" />

        <div class="mt-8 flow-root">
            <x-admin.table.search />

            {{-- Products Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Regular Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">View Count</th>

                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="!font-semibold">
                                                <div class="flex items-center">
                                                    <div class="size-11 shrink-0">
                                                        <img class="size-11 rounded-full"
                                                            src="{{ $product?->thumbnailURL('thumb') }}"
                                                            alt="{{ $product->name }}" loading="lazy"
                                                            fetchpriority="low" />
                                                    </div>
                                                    <div class="ml-4 max-w-lg">
                                                        <div class="font-medium text-gray-900 truncate">
                                                            {{ $product->name }}
                                                        </div>
                                                        <div class="mt-1 text-gray-500 truncate">{{ $product->slug }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>@money($product->regular_price)</td>
                                            <td>@money($product->selling_price)</td>
                                            <td>{{ $product->category?->name }}</td>
                                            <td>{{ $product->brand?->name }}</td>
                                            <td>{{ $product->view_count }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">

                                                <a href="{{ route('products.show', $product->slug) }}"
                                                    class="link-primary relative inline-flex" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-5">
                                                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>

                                                <x-admin.links.edit :href="route('admin.products.edit', $product)" />

                                                <x-admin.links.delete :action="route('admin.products.destroy', $product)" />
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
            {!! $products->links() !!}
        </div>
    </div>
</x-layouts.admin>
