<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.brands.index'),
                    'text' => 'Brands',
                ],
                [
                    'text' => $brand->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $brand->id ? 'Edit ' . $brand->name : 'Create Brand';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.brands.index')" />


        <form method="post"
            action="{{ $brand->id ? route('admin.brands.update', $brand) : route('admin.brands.store') }}">
            @csrf

            @isset($brand->id)
                @method('put')
            @endisset
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4" x-data="{
                        title: '{{ old('name', $brand->name) }}',
                        slug: '{{ old('slug', $brand->slug) }}'
                    }">
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

                        <div class="space-y-2 col-span-2">
                            <label for="description" class="control-label sm:pt-1.5">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
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
                                value="{{ old('seo_title', $brand->seo_title) }}" />
                            @error('seo_title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="seo_description" class="control-label sm:pt-1.5">SEO Description</label>
                            <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description"
                                name="seo_description" rows="3">{{ old('seo_description', $brand->seo_description) }}</textarea>
                            @error('seo_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.brands.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

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
</x-layouts.admin>
