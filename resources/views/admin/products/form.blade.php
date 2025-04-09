<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        <div>
            <nav aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-1">
                    <li>
                        <div class="flex">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">Dashboard</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('admin.products.index') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">Products</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span aria-current="page" class="text-sm font-medium text-gray-600">
                                @isset($product->id)
                                    Edit
                                @else
                                    Create
                                @endisset
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="page-title">
                        @isset($product->id)
                            Edit {{ $product->name }}
                        @else
                            Create Product
                        @endisset
                    </h2>
                </div>
            </div>
        </div>


        <form method="post"
            action="{{ $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf

            @isset($product->id)
                @method('put')
            @endisset
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="name" class="control-label sm:pt-1.5">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="slug" class="control-label sm:pt-1.5">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $product->slug) }}" />
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

                        <div class="space-y-2 col-span-2">
                            <label for="short_description" class="control-label sm:pt-1.5">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                name="short_description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2">
                            <label for="long_description" class="control-label sm:pt-1.5">Long Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description"
                                name="long_description" rows="3">{{ old('long_description', $product->long_description) }}</textarea>
                            @error('long_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

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
</x-layouts.admin>
