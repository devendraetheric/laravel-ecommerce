<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
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
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden ring-1 shadow-sm ring-black/5 sm:rounded-xl">
                        <table class="record-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Regular Price</th>
                                    <th scope="col">Selling Price</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>

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
                                                        alt="{{ $product->name }}" loading="lazy" />
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
                                        <td>${{ $product->regular_price }}</td>
                                        <td>${{ $product->selling_price }}</td>
                                        <td>{{ $product->category?->name }}</td>
                                        <td>{{ $product->brand?->name }}</td>

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

                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="link-primary relative inline-flex">
                                                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                    <path
                                                        d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                    <path
                                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}"
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

        <div class="mt-3">
            {!! $products->links() !!}
        </div>
    </div>
</x-layouts.admin>
