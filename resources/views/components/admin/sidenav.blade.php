<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="showSideNav" x-cloak
    x-transition:enter="transition-opacity ease-linear duration-700" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-700"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

    <div class="fixed inset-0 flex" x-show="showSideNav"
        x-transition:enter="transition ease-in-out duration-700 transform" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-700 transform"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

        <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="showSideNav"
            x-transition:enter="ease-in-out duration-700" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-700"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="absolute top-0 left-full flex w-16 justify-center pt-5">
                <button type="button" class="-m-2.5 p-2.5" @click="showSideNav = false">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                <x-admin.navigation />
            </div>
        </div>
    </div>
</div>

<!-- Static sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
        <x-admin.navigation />
    </div>
</div>
