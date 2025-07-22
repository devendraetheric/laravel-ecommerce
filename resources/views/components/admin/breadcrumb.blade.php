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
                            <i data-lucide="chevron-right" class="size-4 shrink-0 text-gray-400"></i>
                            <span aria-current="page" class="text-sm font-medium text-gray-600">
                                {{ $link['text'] }}
                            </span>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="flex items-center">
                            <i data-lucide="chevron-right" class="size-4 shrink-0 text-gray-400"></i>
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
                    <i data-lucide="plus" class="size-5"></i>
                    <span>Add New</span>
                </a>
            @endisset

            @isset($goBackAction)
                <a href="{{ $goBackAction }}" class="btn-primary gap-1">
                    <i data-lucide="move-left" class="size-5"></i>
                    <span>Go Back</span>
                </a>
            @endisset
        </div>
    </div>
</div>
