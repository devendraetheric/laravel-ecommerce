<!-- Breadcrumb Start -->
<div class="breadcrumb">
    <div class="container px-3 md:px-5 xl:px-0">
        <div class="flex items-center gap-1 py-1">
            <a href="{{ route('home') }}" class="font-medium leading-tight text-dark-gray">Home</a>

            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.125 5.25L10.875 9L7.125 12.75" stroke="#636270" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>

            <span class="font-medium leading-tight font-display text-gray-black inline-block">{{ $title }}</span>
        </div>

        <h2 class="pt-[13.5px] text-2xl font-semibold text-gray-black font-display">{{ $title }}</h2>
    </div>
</div>
<!-- Breadcrumb End -->
