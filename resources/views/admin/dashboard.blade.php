<x-layouts.admin>

    <x-slot name="title">Dashboard | {{ config('app.name') }}</x-slot>

    <div class="rounded-md bg-green-50 p-4">
        <div class="flex">
            <div class="shrink-0">
                <i data-lucide="check" class="size-5 text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">Successfully uploaded</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button"
                        class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50 focus:outline-hidden">
                        <span class="sr-only">Dismiss</span>
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-layouts.admin>
