@inject('settings', 'App\Settings\GeneralSetting')
<x-layouts.front>
    <x-slot name="title">
        {{ $breadcrumbs['title'] }} - {{ $settings->site_name }}
    </x-slot>
    <x-slot name="description">
        {{ $settings->site_description }}
    </x-slot>

    @include('components.common.breadcrumb', $breadcrumbs)

    <section>
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="my-10 xl:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 grid grid-cols-1 gap-6">
                @foreach ($products as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>

            {{ $products->onEachSide(1)->links('pagination::front') }}

        </div>
    </section>
</x-layouts.front>
