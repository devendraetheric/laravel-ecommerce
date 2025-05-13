<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => '#', 'text' => 'Checkout'],
            ],
            'title' => 'Checkout',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <form action="{{ route('account.checkout.store') }}" method="POST">
                @csrf
                <div class="mt-6 lg:grid lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8">
                        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                            <div class="p-6 space-y-6">
                                <fieldset>
                                    <legend class="text-2xl font-semibold text-gray-800">Select a delivery address
                                    </legend>
                                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                        @forelse (auth()->user()->addresses as $address)
                                            <label for="address-{{ $address->id }}"
                                                class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-xs focus-within:ring-1 focus-within:ring-primary-500">
                                                <input type="radio" id="address-{{ $address->id }}" name="address_id"
                                                    value="{{ $address->id }}" class="sr-only" required
                                                    @checked($address->is_default) />
                                                <span class="flex flex-1 flex-col">
                                                    <span
                                                        class="block text-base/6 font-medium text-gray-900">{{ $address->name }}</span>
                                                    <span class="mt-1 text-base/6 text-gray-500">
                                                        {{ $address?->contact_name }} <br>
                                                        {{ $address?->address_line_1 }} ,
                                                        {{ $address?->address_line_2 }}<br>
                                                        {{ $address?->city }},<br>
                                                        {{ $address->state->name }} {{ $address?->country?->iso2 }} -
                                                        {{ $address?->zip_code }}<br>
                                                        Phone Number : {{ $address?->phone }}
                                                    </span>
                                                </span>
                                                <!-- Check Icon (hidden by default) -->
                                                <svg class="size-5 text-primary-600 hidden absolute top-4 right-4 pointer-events-none"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </label>
                                        @empty
                                            <div>
                                                <p class="text-gray-500">No saved addresses found.</p>
                                                <a href="{{ route('account.addresses.create') }}"
                                                    class="btn-primary mt-4">Add Address</a>
                                            </div>
                                        @endforelse
                                    </div>
                                </fieldset>

                                <div class="mt-10 border-t border-gray-200 pt-10">
                                    <h2 class="text-2xl font-semibold text-gray-800">Payment</h2>

                                    <fieldset class="mt-4">
                                        <legend class="sr-only">Payment type</legend>
                                        <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                            <div class="flex items-center">
                                                <input id="cash" name="payment_method" type="radio" checked
                                                    class="form-radio" value="cod" />
                                                <label for="cash"
                                                    class="ml-3 block text-base/6 font-medium text-gray-700">Cash on
                                                    Delivery</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div>
                                    <label for="notes"
                                        class="block text-base/6 font-medium text-gray-600">Notes</label>
                                    <textarea id="notes" name="notes" class="form-control mt-2" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 mt-6 lg:mt-0">
                        <div class="rounded-xl bg-white shadow-sm">
                            <div class="p-6">
                                @foreach (cart()->items as $product)
                                    <!-- cart item start  -->
                                    <div class="block pb-4">
                                        <div class="flex items-start space-y-4 gap-3">
                                            <div class="min-w-24">
                                                <img class="w-24 rounded-md"
                                                    src="{{ $product->product->thumbnailURL('thumb') }}"
                                                    alt="{{ $product->product->name }}" loading="lazy" />
                                            </div>
                                            <div class="inline-block w-full">
                                                <a class="text-gray-700 text-base"
                                                    href="{{ route('products.show', $product->product) }}">{{ $product->product->name }}</a>

                                                <div class="mt-2 flex justify-between">
                                                    <p class="text-gray-700 text-base/tight">Qty:
                                                        <span class="font-semibold">{{ $product->quantity }}</span>
                                                    </p>
                                                    <p class="text-gray-800 text-base/tight font-bold">
                                                        @money($product->total)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- cart item end -->
                                <dl class="space-y-6 mt-10">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                        <dd class="text-base/6 font-medium text-gray-900">@money(cart()->total)</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                        <dd class="text-base/6 font-bold text-gray-900">@money(cart()->total)</dd>
                                    </div>
                                </dl>

                                <button type="submit" class="w-full btn-primary mt-8">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                // Select all fieldsets that contain radio groups
                const fieldsets = document.querySelectorAll('fieldset');

                fieldsets.forEach(fieldset => {
                    // Select all labels inside this fieldset
                    const labels = fieldset.querySelectorAll('label');

                    // Function to update UI for this fieldset
                    function updateUI() {
                        labels.forEach(label => {
                            const input = label.querySelector('input[type="radio"]');
                            const icon = label.querySelector('svg');
                            if (input.checked) {
                                label.classList.remove('border-gray-300');
                                label.classList.add('border-primary-500');
                                icon.classList.remove('hidden');
                            } else {
                                label.classList.remove('border-primary-500');
                                label.classList.add('border-gray-300');
                                icon.classList.add('hidden');
                            }
                        });
                    }

                    // Initialize UI on page load for this fieldset
                    updateUI();

                    // Add event listeners to inputs in this fieldset
                    labels.forEach(label => {
                        const input = label.querySelector('input[type="radio"]');
                        input.addEventListener('change', () => {
                            updateUI();
                        });
                    });
                });
            });
        </script>
    @endpush
</x-layouts.front>
