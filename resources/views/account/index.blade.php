<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Dashboard']],
            'title' => 'Dashboard',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <x-account.nav />

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl/6 font-semibold text-gray-800">Hello {{ Auth()->user()->name }}</h3>
                </div>
                <div class="p-6">
                    <p class="text-base/6 text-gray-800">
                        From your account dashboard you can view your recent orders, manage your shipping and billing
                        addresses,
                        and
                        edit your password and account details.
                    </p>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
