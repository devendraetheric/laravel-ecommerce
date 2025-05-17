<div class="relative z-100" role="dialog" aria-modal="true" x-show="openSearch" x-cloak>
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/25 transition-opacity" aria-hidden="true" x-show="openSearch"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Modal container -->
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20" x-show="openSearch" x-cloak>
        <!-- Modal box -->
        <div class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black/5 transition-all"
            @click.outside="openSearch=false" x-show="openSearch" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">
            <div class="grid grid-cols-1">
                <input type="text" x-ref="searchInput" x-model="query" @input.debounce.300ms="fetchResults"
                    class="col-start-1 row-start-1 h-12 w-full pr-4 pl-11 text-base text-gray-900 outline-hidden placeholder:text-gray-400 sm:text-sm"
                    placeholder="Search here..." role="combobox" aria-expanded="false" aria-controls="options">
                <svg class="pointer-events-none col-start-1 row-start-1 ml-4 size-5 self-center text-gray-400"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Skeleton Loader -->
            <template x-if="loading">
                <ul class="max-h-96 transform-gpu scroll-py-3 overflow-y-auto p-3">
                    <template x-for="i in 4" :key="i">
                        <li class="flex animate-pulse space-x-4 rounded-xl p-3">
                            <div class="h-10 w-10 rounded-lg bg-gray-300"></div>
                            <div class="flex-1 space-y-2 py-1">
                                <div class="h-4 w-3/4 rounded bg-gray-300"></div>
                                <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                            </div>
                        </li>
                    </template>
                </ul>
            </template>

            <!-- Results -->
            <ul class="max-h-96 transform-gpu scroll-py-3 overflow-y-auto p-3" id="options" role="listbox"
                x-show="results.length>0 && !loading">
                <template x-for="(result, index) in results" :key="index">
                    <a class="group flex rounded-xl p-3 hover:bg-gray-100" id="option-1" role="option" tabindex="-1"
                        :href="result.url">
                        <div class="flex size-10 flex-none items-center justify-center rounded-lg">
                            <img class="size-10" :src="result.media_url" />
                        </div>
                        <div class="ml-4 flex-auto">
                            <p class="text-sm font-medium text-gray-700" x-text="result.name"></p>
                            <p class="text-sm text-gray-500 line-clamp-1" x-text="result.short_description"></p>
                        </div>
                    </a>
                </template>
            </ul>

            <!-- Empty state -->
            <div class="px-6 py-14 text-center text-sm sm:px-14"
                x-show="query.length>2 && results.length==0 && !loading">
                <svg class="mx-auto size-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <p class="mt-4 font-semibold text-gray-900">No results found</p>
                <p class="mt-2 text-gray-500">No components found for this search term. Please try again.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function searchModal() {
            return {
                query: '',
                results: [],
                loading: false,
                success: false,

                async fetchResults() {
                    if (this.query.length < 2) {
                        this.results = [];
                        return;
                    }

                    this.loading = true;

                    try {
                        const res = await fetch(
                            `{{ route('products.search') }}?query=${encodeURIComponent(this.query)}`);
                        const data = await res.json();
                        this.results = data || [];
                    } catch (e) {
                        console.error("Search failed:", e);
                        this.results = [];
                    }

                    this.loading = false;
                }
            };
        }
    </script>
@endpush
