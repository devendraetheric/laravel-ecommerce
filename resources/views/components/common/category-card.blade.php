<div class="relative w-full inline-block rounded-xl overflow-hidden border border-gray-200">
    <div class="group rounded-xl">
        <div class="w-full">
            <a href="{{ route('products.byCategory', $category) }}">
                <img class="w-full object-cover transition duration-500 ease-out delay-0 group-hover:scale-110"
                    src="{{ $category?->thumbnailURL('thumb') }}" alt="{{ $category->name }}" loading="lazy"
                    fetchpriority="low" />
            </a>
        </div>

        <div class="bg-gray-900 opacity-70 p-5 absolute bottom-0 w-full rounded-b-lg text-white">
            <h3 class="font-normal text-xl leading-tight mb-2 line-clamp-1">
                <a href="{{ route('products.byCategory', $category) }}">{{ $category->name }}</a>
            </h3>
            <p class="text-sm leading-tight">{{ $category->products_count }} Products</p>
        </div>
    </div>
</div>
