<figure class="relative rounded-xl bg-white p-6 shadow-lg ring-1 ring-gray-900/5">
    <blockquote class="text-gray-900">
        <p>{{ $review['review'] }}</p>
    </blockquote>
    <figcaption class="mt-6 flex items-center gap-x-4">
        <span class="inline-block size-10 overflow-hidden rounded-full bg-gray-100">
            <svg class="size-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </span>
        <div class="font-semibold">{{ $review['name'] }}</div>
    </figcaption>
</figure>
