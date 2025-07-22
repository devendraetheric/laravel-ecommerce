<div class="group card-modern overflow-hidden relative">
    <a href="{{ route('products.byCategory', $category) }}" class="block">
        <div class="relative overflow-hidden aspect-[4/3]">
            <img class="w-full h-full object-cover"
                src="{{ $category?->thumbnailURL('thumb') }}" alt="{{ $category->name }}" loading="lazy"
                fetchpriority="low" />
            
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            
            <!-- Content overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                <div class="transform transition-transform duration-300 group-hover:-translate-y-1">
                    <h3 class="font-bold text-xl mb-2 line-clamp-1 group-hover:text-primary-300 transition-colors duration-300">
                        {{ $category->name }}
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-white/80">{{ $category->products_count }} Products</span>
                        <i data-lucide="arrow-right" class="size-4 text-primary-400 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                    </div>
                </div>
            </div>
            
            <!-- Hover effect overlay -->
            <div class="absolute inset-0 bg-primary-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
    </a>
</div>
