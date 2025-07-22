<!-- resources/views/components/breadcrumb.blade.php -->

<div class="bg-gray-100 pt-3 pb-2 mx-auto">
    <div class="container px-3 md:px-5 xl:px-0">
        <div class="flex items-center gap-1 py-1">
            @foreach ($links as $link)
                @if ($loop->first)
                    <a href="{{ $link['url'] }}" class="font-medium leading-tight text-gray-600">{{ $link['text'] }}</a>
                @elseif($loop->last)
                    <i data-lucide="chevron-right" class="size-5 text-gray-400"></i>
                    <span class="font-medium leading-tight text-gray-800 inline-block">{{ $link['text'] }}</span>
                @else
                    <i data-lucide="chevron-right" class="size-5 text-gray-200"></i>
                    <a href="{{ $link['url'] }}"
                        class="font-medium leading-tight text-gray-600 inline-block">{{ $link['text'] }}</a>
                @endif
            @endforeach
        </div>

        {{-- <h1 class="text-2xl lg:text-4xl font-semibold text-gray-800">{{ $title }}</h1> --}}
    </div>
</div>
