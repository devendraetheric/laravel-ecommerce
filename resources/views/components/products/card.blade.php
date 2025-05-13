<div class="relative w-full inline-block bg-white rounded-xl shadow-xs p-6 border border-gray-200">
    <div>
        <a href="{{ route('products.show', $product) }}">
            <div class="overflow-hidden aspect-square items-center bg-gray-50 mb-2 relative rounded-lg">
                <img class="w-full object-contain aspect-square rounded-xs" src="{{ $product->thumbnailURL() }}"
                    alt="{{ $product?->name }}" loading="lazy" fetchpriority="low" />
            </div>
        </a>
        <div>
            <a href="{{ route('products.show', $product) }}">
                <h3 class="text-base/6 text-gray-700 mb-2.5 line-clamp-2">
                    {{ $product?->name }}</h3>
            </a>
            <p class="flex gap-2 items-center">
                <span class="text-gray-800 text-lg">@money($product->selling_price)</span>
                {{-- <span class="text-red-600 opacity-70 text-lg line-through">${{ $product->regular_price }}</span> --}}
            </p>
        </div>
        <div class="mt-2 flex w-full items-center gap-2">
            <form action="{{ route('products.addToCart') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="quantity" value="1" />
                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <button class="btn-primary w-full gap-2">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.52081 2.97913L4.42748 3.30913L5.31023 13.826C5.34414 14.2399 5.53284 14.6257 5.83867 14.9066C6.14451 15.1875 6.545 15.3427 6.96023 15.3413H16.9611C17.3586 15.3417 17.743 15.1986 18.0435 14.9382C18.344 14.6778 18.5403 14.3177 18.5964 13.9241L19.4672 7.91263C19.4904 7.75275 19.4819 7.58987 19.4421 7.43329C19.4023 7.27671 19.3321 7.12951 19.2354 7.00011C19.1387 6.8707 19.0174 6.76163 18.8785 6.67913C18.7396 6.59663 18.5858 6.54231 18.4259 6.51929C18.3672 6.51288 4.73365 6.50829 4.73365 6.50829"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.9479 9.89539H15.4898" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.5578 18.5194C6.62502 18.5165 6.69213 18.5272 6.75509 18.551C6.81805 18.5747 6.87556 18.611 6.92414 18.6575C6.97273 18.704 7.01139 18.7599 7.03781 18.8218C7.06422 18.8837 7.07784 18.9503 7.07784 19.0176C7.07784 19.0849 7.06422 19.1515 7.03781 19.2133C7.01139 19.2752 6.97273 19.3311 6.92414 19.3777C6.87556 19.4242 6.81805 19.4605 6.75509 19.4842C6.69213 19.5079 6.62502 19.5187 6.5578 19.5158C6.42936 19.5103 6.30801 19.4554 6.21908 19.3626C6.13015 19.2697 6.08051 19.1461 6.08051 19.0176C6.08051 18.889 6.13015 18.7654 6.21908 18.6726C6.30801 18.5798 6.42936 18.5249 6.5578 18.5194Z"
                            fill="#272343" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.8988 18.5194C17.0312 18.5194 17.1583 18.572 17.252 18.6657C17.3457 18.7594 17.3983 18.8865 17.3983 19.019C17.3983 19.1515 17.3457 19.2786 17.252 19.3723C17.1583 19.4659 17.0312 19.5186 16.8988 19.5186C16.7663 19.5186 16.6392 19.4659 16.5455 19.3723C16.4518 19.2786 16.3992 19.1515 16.3992 19.019C16.3992 18.8865 16.4518 18.7594 16.5455 18.6657C16.6392 18.572 16.7663 18.5194 16.8988 18.5194Z"
                            fill="#272343" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Add to Cart
                </button>
            </form>
            <a href="{{ route('account.addToWishlist', $product->id) }}"
                class="rounded-md bg-white px-3 py-3 text-sm font-bold text-primary-600 border border-primary-300 hover:bg-primary-50"
                data-product-name="{{ $product->name }}" aria-label="Add {{ $product->name }} to wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </a>
        </div>
    </div>
</div>
