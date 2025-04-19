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
                    'text' => $product->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $product->id ? 'Edit ' . $product->name : 'Create Product';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.products.index')" />


        <form method="post"
            action="{{ $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($product->id)
                @method('put')
            @endisset
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6" x-data="{
                    title: '{{ old('name', $product->name) }}',
                    slug: '{{ old('slug', $product->slug) }}'
                }">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="name" class="control-label sm:pt-1.5">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" x-model="title"
                                @input="slug = slugify(title)" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="slug" class="control-label sm:pt-1.5">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror" x-model="slug" readonly />
                            @error('slug')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="brand_id" class="control-label sm:pt-1.5">Brand</label>
                            <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                    <select name="brand_id" id="brand_id"
                                        class="col-start-1 row-start-1 form-select @error('brand_id') is-invalid @enderror">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $key => $brand)
                                            <option value="{{ $key }}" @selected(old('brand_id', $product->brand_id) == $key)>
                                                {{ $brand }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('brand_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="category_id" class="control-label sm:pt-1.5">Category</label>
                            <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                    <select name="category_id" id="category_id"
                                        class="col-start-1 row-start-1 form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $key }}" @selected(old('category_id', $product->category_id) == $key)>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('category_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="image" class="block text-sm/6 font-medium text-gray-900">Featured
                                Image</label>
                            <input id="image" name="image" type="file" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <x-forms.rich-text-editor name="short_description">{!! old('short_description', $product->short_description) !!}</x-forms.rich-text-editor>

            <x-forms.rich-text-editor name="long_description">{!! old('long_description', $product->long_description) !!}</x-forms.rich-text-editor>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Pricing</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="regular_price" class="control-label sm:pt-1.5">Regular Price</label>
                            <input type="text" name="regular_price" id="regular_price"
                                class="form-control @error('regular_price') is-invalid @enderror"
                                value="{{ old('regular_price', $product->regular_price) }}" />
                            @error('regular_price')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="selling_price" class="control-label sm:pt-1.5">Selling Price</label>
                            <input type="text" name="selling_price" id="selling_price"
                                class="form-control @error('selling_price') is-invalid @enderror"
                                value="{{ old('selling_price', $product->selling_price) }}" />
                            @error('selling_price')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">SEO</h3>
                </div>
                <div class="p-6">
                    <div class="grid gap-4">
                        <div class="space-y-2">
                            <label for="seo_title" class="control-label sm:pt-1.5">SEO Title</label>
                            <input type="text" seo_title="seo_title" id="seo_title"
                                class="form-control @error('seo_title') is-invalid @enderror"
                                value="{{ old('seo_title', $product->seo_title) }}" />
                            @error('seo_title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="seo_description" class="control-label sm:pt-1.5">SEO Description</label>
                            <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description"
                                name="seo_description" rows="3">{{ old('seo_description', $product->seo_description) }}</textarea>
                            @error('seo_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function slugify(str) {
                return str
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        </script>
    @endpush
</x-layouts.admin>
