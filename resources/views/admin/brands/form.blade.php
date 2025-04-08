<x-layouts.admin>
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
                        <a href="{{ route('admin.brands.create') }}"
                            class="text-sm font-medium text-gray-500 hover:text-gray-700">Brands</a>
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
                            @isset($brand->id)
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
                    @isset($brand->id)
                        Edit {{ $brand->name }}
                    @else
                        Create Brand
                    @endisset
                </h2>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2">
        <div class="col-span-2 lg:col-span-1">
            <form method="post"
                action="{{ $brand->id ? route('admin.brands.update', $brand) : route('admin.brands.store') }}">
                @csrf

                @isset($brand->id)
                    @method('put')
                @endisset
                <div class="mt-6 overflow-hidden rounded-lg bg-white shadow">
                    <div class="px-4 pt-5 space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label for="name" class="control-label sm:pt-1.5">Name</label>
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $brand->name) }}" />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label for="slug" class="control-label sm:pt-1.5">Slug</label>
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input type="text" name="slug" id="slug"
                                    class="form-control @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $brand->slug) }}" readonly />
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label for="description" class="control-label sm:pt-1.5">Description</label>
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label for="seo_title" class="control-label sm:pt-1.5">SEO Title</label>
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <input type="text" name="seo_title" id="seo_title"
                                    class="form-control @error('seo_title') is-invalid @enderror"
                                    value="{{ old('seo_title', $brand->seo_title) }}" />
                                @error('seo_title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label for="seo_description" class="control-label sm:pt-1.5">SEO Description</label>
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description"
                                    name="seo_description" rows="3">{{ old('seo_description', $brand->seo_description) }}</textarea>
                                @error('seo_description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 space-x-2 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.brands.index') }}"
                            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
