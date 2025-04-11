<div>
    <nav aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-1">
            @foreach ($links as $link)
                @if ($loop->first)
                    <li>
                        <div class="flex">
                            <a href="{{ $link['url'] }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $link['text'] }}</a>
                        </div>
                    </li>
                @elseif ($loop->last)
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span aria-current="page" class="text-sm font-medium text-gray-600">
                                {{ $link['text'] }}
                            </span>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ $link['url'] }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">{{ $link['text'] }}</a>
                        </div>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
    <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="page-title">{{ $title }}</h2>
        </div>
        <div class="mt-4 flex shrink-0 md:ml-4 md:mt-0">
            @isset($addNewAction)
                <a href="{{ $addNewAction }}" class="btn-primary gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    <span>Add New</span>
                </a>
            @endisset

            @isset($goBackAction)
                <a href="{{ $goBackAction }}" class="btn-primary gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Go Back</span>
                </a>
            @endisset
        </div>
    </div>
</div>
