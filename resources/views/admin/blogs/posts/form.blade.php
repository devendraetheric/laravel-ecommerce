<x-layouts.admin>
    <div class="max-w-7xl mx-auto">

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
                    'text' => $blog_post->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $blog_post->id ? 'Edit ' . $blog_post->title : 'Create Blog Post';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.blogs.posts.index')" />

        <form method="post"
            action="{{ $blog_post->id ? route('admin.blogs.posts.update', $blog_post) : route('admin.blogs.posts.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($blog_post->id)
                @method('put')
            @endisset

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-8">
                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6" x-data="{
                            title: '{{ addslashes(old('title', $blog_post->title)) }}',
                            slug: '{{ old('slug', $blog_post->slug) }}'
                        }">
                            <div class="space-y-2">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" x-model="title"
                                    @input="slug = slugify(title)" />
                                @error('title')
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
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Content</h3>
                        <x-forms.rich-text-editor name="content">{!! old('content', $blog_post->content) !!}</x-forms.rich-text-editor>
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
                                        value="{{ old('seo_title', $blog_post->seo_title) }}" />
                                    @error('seo_title')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="seo_description" class="control-label">SEO
                                        Description</label>
                                    <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description"
                                        name="seo_description" rows="3">{{ old('seo_description', $blog_post->seo_description) }}</textarea>
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
                            <select name="status" id="status"
                                class="form-select @error('status') is-invalid @enderror">
                                <option value="published" @selected(old('status', $blog_post->published) == 'published')>
                                    Published
                                </option>
                                <option value="draft" @selected(old('status', $blog_post->draft) == 'draft')>
                                    Draft
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-semibold text-gray-800">Associations</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">

                                <div class="space-y-2">
                                    <label for="category_combobox" class="control-label">Category</label>
                                    <div class="relative" x-data="categoryCombobox()">
                                        <input x-model="query" @input="searchCategories" @focus="open = !open"
                                            @keydown.arrow-down.prevent="highlightNext()"
                                            @keydown.arrow-up.prevent="highlightPrev()"
                                            @keydown.enter.prevent="selectHighlighted()" id="category_combobox"
                                            type="text" name="category_name"
                                            class="form-control @error('blog_category_id') is-invalid @enderror"
                                            role="combobox" :aria-expanded="open" autocomplete="off">
                                        <input type="hidden" name="blog_category_id" id="blog_category_id"
                                            x-model="selectedId" />
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                                            @click="open = !open">
                                            <i data-lucide="chevrons-up-down" class="size-5 text-gray-400"></i>
                                        </button>

                                        <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                                            role="listbox" x-show="open && results.length" @click.away="open = !open">
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
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    @error('blog_category_id')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="published_at" class="control-label">Published At</label>
                                    <input type="date" name="published_at" id="published_at"
                                        class="form-control @error('published_at') is-invalid @enderror"
                                        value="{{ old('published_at', $blog_post->published_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                                    @error('published_at')
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
                                        <i data-lucide="image" class="mx-auto size-12 text-gray-300"></i>
                                        <div class="mt-4 flex text-sm/6 text-gray-600">
                                            <label for="image"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-primary-500">
                                                <span>Upload Featured Image</span>
                                                <input id="image" name="image" type="file"
                                                    class="sr-only" />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.blogs.posts.index') }}" class="btn-secondary">Cancel</a>
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


        function categoryCombobox() {
            return {
                open: false,
                query: "{{ old('category_name', $blog_post->blogCategory->name ?? '') }}",
                results: [],
                highlighted: -1,
                selectedId: "{{ old('blog_category_id', $blog_post->blog_category_id) }}",
                searchCategories() {
                    if (this.query.length < 1) {
                        this.results = [];
                        return;
                    }
                    fetch(`{{ route('admin.blogs.categories.search') }}?q=${encodeURIComponent(this.query)}`)
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
</x-layouts.admin>
