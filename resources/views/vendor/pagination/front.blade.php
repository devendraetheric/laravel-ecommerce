@if ($paginator->hasPages())
    <div class="flex items-center justify-center pb-10">
        <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs gap-2" aria-label="Pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            aria-hidden="true">
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-primary-200 hover:ring-primary-600 hover:text-primary-600 focus:z-20 focus:outline-offset-0"
                        aria-label="{{ __('pagination.previous') }}">
                        <span class="sr-only">Previous</span>
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold text-primary-600 ring-1 ring-gray-300 ring-inset focus:outline-offset-0">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span
                                        class="relative z-10 inline-flex items-center bg-primary-200 rounded-md px-4 py-2 text-sm font-semibold text-primary-600 ring-1 ring-primary-600 focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="relative inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-primary-200 hover:text-primary-600 hover:ring-primary-600 focus:z-20 focus:outline-offset-0"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-primary-200 hover:ring-primary-600 hover:text-primary-600 focus:z-20 focus:outline-offset-0"
                        aria-label="{{ __('pagination.next') }}">
                        <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative inline-flex items-center rounded-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                            aria-hidden="true">
                            <span class="sr-only">Next</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </nav>
        </div>
    </div>
@endif
