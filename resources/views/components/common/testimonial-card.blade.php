<figure class="relative rounded-2xl bg-white p-8 shadow-card border border-accent-100 hover:border-primary-200 transition-all duration-300">
    <div class="text-primary-600 mb-4">
        <i data-lucide="quote" class="size-8 opacity-50"></i>
    </div>
    <blockquote class="text-accent-700 text-lg">
        <p>{{ $review['review'] }}</p>
    </blockquote>
    <figcaption class="mt-6 flex items-center gap-x-4">
        <span class="inline-flex size-12 overflow-hidden rounded-full bg-primary-100 items-center justify-center">
            <i data-lucide="user" class="size-6 text-primary-600"></i>
        </span>
        <div class="font-bold text-accent-900">{{ $review['name'] }}</div>
    </figcaption>
</figure>
