<div class="group card-modern relative overflow-hidden">
    <!-- Wishlist Button - Positioned absolutely -->
    <a href="{{ route('account.addToWishlist', $product->id) }}"
        class="absolute top-2 right-2 z-10 p-2 rounded-full bg-white/90 backdrop-blur-sm border border-accent-200 text-accent-600 opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-primary-50 hover:text-primary-600 hover:border-primary-200"
        data-product-name="{{ $product->name }}" aria-label="Add {{ $product->name }} to wishlist">
        <i data-lucide="heart" class="size-4"></i>
    </a>

    <div>
        <a href="{{ route('products.show', $product) }}" class="block">
            <div class="overflow-hidden aspect-square bg-white relative">
                <img class="w-full h-full object-contain" src="{{ $product->thumbnailURL('thumb') }}"
                    alt="{{ $product?->name }}" loading="lazy" fetchpriority="low" />
                <!-- Overlay gradient on hover -->
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
        </a>

        <div class="px-3 py-2 space-y-1">
            <a href="{{ route('products.show', $product) }}" class="block">
                <h3
                    class="text-base font-medium text-accent-800 line-clamp-1 group-hover:text-primary-600 transition-colors duration-300">
                    {{ $product?->name }}
                </h3>
            </a>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-lg font-bold text-primary-600">@money($product->selling_price)</span>
                    @if ($product->regular_price > $product->selling_price)
                        <span class="text-sm text-accent-500 line-through">@money($product->regular_price)</span>
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full font-medium">
                            {{ round((($product->regular_price - $product->selling_price) / $product->regular_price) * 100) }}%
                            OFF
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <form action="{{ route('products.addToCart') }}" method="POST" class="w-full px-3 pb-3 pt-1">
            @csrf
            <input type="hidden" name="quantity" value="1" />
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <button class="btn-primary w-full gap-1 text-xs py-2">
                <i data-lucide="shopping-cart" class="size-4"></i>
                Add to Cart
            </button>
        </form>
    </div>
</div>
