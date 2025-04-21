<!-- resources/views/components/breadcrumb.blade.php -->

<div class="bg-gray-100 py-12 mx-auto">
    <div class="container px-3 md:px-5 xl:px-0">
        <div class="flex items-center gap-1 py-1">
            @foreach ($links as $link)
                @if ($loop->first)
                    <a href="{{ $link['url'] }}" class="font-medium leading-tight text-gray-600">{{ $link['text'] }}</a>
                @elseif($loop->last)
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="font-medium leading-tight text-gray-800 inline-block">{{ $link['text'] }}</span>
                @else
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <a href="{{ $link['url'] }}"
                        class="font-medium leading-tight text-gray-600 inline-block">{{ $link['text'] }}</a>
                @endif
            @endforeach
        </div>

        <h2 class="pt-4 text-2xl lg:text-4xl font-semibold text-gray-800">{{ $title }}</h2>
    </div>
</div>
