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

            {{-- Display All Errors --}}
            @if ($errors->any())
                <div class="mb-4">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-8">
                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6" x-data="{
                            title: '{{ addslashes(old('name', $product->name)) }}',
                            slug: '{{ old('slug', $product->slug) }}'
                        }">
                            <div class="space-y-2">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" x-model="title"
                                    @input="slug = slugify(title)" />
                                @error('name')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <p class="text-sm text-gray-600">
                                    <strong>Slug : </strong>
                                    <span x-text="slug"></span>
                                    <input type="hidden" name="slug" :value="slug" />
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Short Description</h3>
                        <x-forms.rich-text-editor
                            name="short_description">{!! old('short_description', $product->short_description) !!}</x-forms.rich-text-editor>
                    </div>

                    <div class="mt-6">
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Long Description</h3>
                        <x-forms.rich-text-editor
                            name="long_description">{!! old('long_description', $product->long_description) !!}</x-forms.rich-text-editor>
                    </div>

                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Pricing</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="regular_price" class="control-label">Regular Price</label>
                                    <input type="text" name="regular_price" id="regular_price"
                                        class="form-control @error('regular_price') is-invalid @enderror"
                                        value="{{ old('regular_price', $product->regular_price) }}" />
                                    @error('regular_price')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="selling_price" class="control-label">Selling Price</label>
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

                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Inventory</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="sku" class="control-label">SKU (Stock Keeping
                                        Unit)</label>
                                    <input type="text" name="sku" id="sku"
                                        class="form-control @error('sku') is-invalid @enderror"
                                        value="{{ old('sku', $product->sku) }}" />
                                    @error('sku')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="barcode" class="control-label">Barcode (ISBN, UPC, GTIN,
                                        etc.)</label>
                                    <input type="text" name="barcode" id="barcode"
                                        class="form-control @error('barcode') is-invalid @enderror"
                                        value="{{ old('barcode', $product->barcode) }}" />
                                    @error('barcode')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">SEO</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid gap-4">
                                <div class="space-y-2">
                                    <label for="seo_title" class="control-label">SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title"
                                        class="form-control @error('seo_title') is-invalid @enderror"
                                        value="{{ old('seo_title', $product->seo_title) }}" />
                                    @error('seo_title')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="seo_description" class="control-label">SEO
                                        Description</label>
                                    <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description"
                                        name="seo_description" rows="3">{{ old('seo_description', $product->seo_description) }}</textarea>
                                    @error('seo_description')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Status</h3>
                        </div>
                        <div class="p-6">
                            <script>
                                var is_featured = '{{ old('is_featured', $product->is_featured) }}';
                            </script>
                            <div class="flex items-center" x-data="{
                                isFeatured: is_featured == 1 ? true : false,
                            }">
                                <button type="button" :class="isFeatured ? 'bg-primary-600' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 focus:outline-hidden"
                                    role="switch" :aria-checked="isFeatured" aria-labelledby="annual-billing-label"
                                    @click="isFeatured = !isFeatured">
                                    <span aria-hidden="true" :class="isFeatured ? 'translate-x-5' : 'translate-x-0'"
                                        class="pointer-events-none inline-block size-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                                <span class="ml-3 text-sm" id="annual-billing-label">
                                    <span class="font-medium text-gray-900">Featured Product</span>
                                </span>
                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="is_featured" :value="isFeatured ? 1 : 0" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Associations</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label for="brand_name" class="control-label">Brand</label>
                                    <div class="relative" x-data="brandCombobox()">
                                        <input x-model="query" @input="searchBrands" @focus="open = !open"
                                            @keydown.arrow-down.prevent="highlightNext()"
                                            @keydown.arrow-up.prevent="highlightPrev()"
                                            @keydown.enter.prevent="selectHighlighted()" id="brand_combobox"
                                            type="text" name="brand_name" id="brand_name"
                                            class="form-control @error('brand_id') is-invalid @enderror"
                                            role="combobox" :aria-expanded="open" autocomplete="off">
                                        <input type="hidden" name="brand_id" id="brand_id" x-model="selectedId" />

                                        <button type="button"
                                            class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                                            @click="open = !open">
                                            <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd"
                                                    d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                                            role="listbox" x-show="open && results.length"
                                            @click.away="open = !open">
                                            <template x-for="(item, i) in results" :key="item.id">
                                                <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none"
                                                    id="option-0" role="option" tabindex="-1"
                                                    :class="{
                                                        'text-white bg-primary-600 outline-hidden': selectedId == item
                                                            .id,
                                                        'text-white bg-primary-600 outline-hidden': highlighted == i,
                                                    }"
                                                    @click="selectBrand(item)" @mouseenter="highlighted = i">
                                                    <span class="block truncate"
                                                        :class="{
                                                            'font-semibold': selectedId == item.id
                                                        }"
                                                        x-text="item.name"></span>
                                                    <span
                                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                                                        :class="{
                                                            'text-white': selectedId == item.id,
                                                            'text-white': highlighted == i,
                                                        }">
                                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd"
                                                                d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    @error('brand_id')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="category_name" class="control-label">Category</label>
                                    <div class="relative" x-data="categoryCombobox()">
                                        <input x-model="query" @input="searchCategories" @focus="open = !open"
                                            @keydown.arrow-down.prevent="highlightNext()"
                                            @keydown.arrow-up.prevent="highlightPrev()"
                                            @keydown.enter.prevent="selectHighlighted()" id="category_combobox"
                                            type="text" name="category_name" id="category_name"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            role="combobox" :aria-expanded="open" autocomplete="off">
                                        <input type="hidden" name="category_id" id="category_id"
                                            x-model="selectedId" />
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                                            @click="open = !open">
                                            <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd"
                                                    d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                                            role="listbox" x-show="open && results.length"
                                            @click.away="open = !open">
                                            <template x-for="(item, i) in results" :key="item.id">
                                                <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none"
                                                    id="option-0" role="option" tabindex="-1"
                                                    :class="{
                                                        'text-white bg-primary-600 outline-hidden': selectedId == item
                                                            .id,
                                                        'text-white bg-primary-600 outline-hidden': highlighted == i,
                                                    }"
                                                    @click="selectCategory(item)" @mouseenter="highlighted = i">
                                                    <span class="block truncate"
                                                        :class="{
                                                            'font-semibold': selectedId == item.id
                                                        }"
                                                        x-text="item.name"></span>
                                                    <span
                                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                                                        :class="{
                                                            'text-white': selectedId == item.id,
                                                            'text-white': highlighted == i,
                                                        }">
                                                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd"
                                                                d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    @error('category_id')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Featured Image</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-2">
                                <div
                                    class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm/6 text-gray-600">
                                            <label for="featured-image"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-primary-500">
                                                <span>Upload Featured Image</span>
                                                <input id="featured-image" name="featured-image" type="file"
                                                    class="sr-only" />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('featured-image')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Product Gallery Images</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-2">
                                <div
                                    class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm/6 text-gray-600">
                                            <label for="product-images"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-primary-500">
                                                <span>Upload Gallery Images</span>
                                                <input id="product-images" name="product-images[]" type="file"
                                                    class="sr-only" multiple />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('product-images')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
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

            function brandCombobox() {
                return {
                    open: false,
                    query: "{{ old('brand_name', $product->brand->name ?? '') }}",
                    results: [],
                    highlighted: -1,
                    selectedId: "{{ old('brand_id', $product->brand_id) }}",
                    searchBrands() {
                        if (this.query.length < 1) {
                            this.results = [];
                            return;
                        }
                        fetch(`{{ route('admin.brands.search') }}?q=${encodeURIComponent(this.query)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.highlighted = -1;
                                this.selectedId = "";
                            });
                    },
                    highlightNext() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted + 1) % this.results.length;
                    },
                    highlightPrev() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted - 1 + this.results.length) % this.results.length;
                    },
                    selectHighlighted() {
                        if (this.highlighted >= 0 && this.results[this.highlighted]) {
                            this.selectBrand(this.results[this.highlighted]);
                        }
                    },
                    selectBrand(item) {
                        this.query = item.name;
                        this.selectedId = item.id;
                        this.open = false;
                    }
                }
            }

            function categoryCombobox() {
                return {
                    open: false,
                    query: "{{ old('category_name', $product->category->name ?? '') }}",
                    results: [],
                    highlighted: -1,
                    selectedId: "{{ old('category_id', $product->category_id) }}",
                    searchCategories() {
                        if (this.query.length < 1) {
                            this.results = [];
                            return;
                        }
                        fetch(`{{ route('admin.categories.search') }}?q=${encodeURIComponent(this.query)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.highlighted = -1;
                                this.selectedId = "";
                            });
                    },
                    highlightNext() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted + 1) % this.results.length;
                    },
                    highlightPrev() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted - 1 + this.results.length) % this.results.length;
                    },
                    selectHighlighted() {
                        if (this.highlighted >= 0 && this.results[this.highlighted]) {
                            this.selectCategory(this.results[this.highlighted]);
                        }
                    },
                    selectCategory(item) {
                        this.query = item.name;
                        this.selectedId = item.id;
                        this.open = false;
                    }
                }
            }
        </script>
    @endpush
</x-layouts.admin>
