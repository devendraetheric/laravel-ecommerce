<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
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
                <div class="mt-6 lg:grid lg:grid-cols-12 gap-6" x-data="checkoutTax()" x-init="fetchTaxes()">
                    <div class="lg:col-span-8">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="p-6 space-y-6">
                                @if (auth()->check())

                                    <fieldset>
                                        <legend class="text-2xl font-semibold text-gray-800">Select a delivery
                                            address
                                        </legend>
                                        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                            @forelse (auth()?->user()?->addresses as $address)
                                                <label for="address-{{ $address->id }}"
                                                    class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 shadow-xs focus-within:ring-1 focus-within:ring-primary-500">
                                                    <input type="radio" id="address-{{ $address->id }}"
                                                        name="address_id" value="{{ $address->id }}" class="sr-only"
                                                        required @checked($address->is_default) x-model="addressId"
                                                        @change="fetchTaxes" />
                                                    <span class="flex flex-1 flex-col">
                                                        <span
                                                            class="block text-base/6 font-medium text-gray-900">{{ $address->name }}</span>
                                                        <span class="mt-1 text-base/6 text-gray-500">
                                                            {{ $address?->contact_name }} <br>
                                                            {{ $address?->address_line_1 }} ,
                                                            {{ $address?->address_line_2 }}<br>
                                                            {{ $address?->city }},<br>
                                                            {{ $address->state->name }}
                                                            {{ $address?->country?->iso2 }}
                                                            -
                                                            {{ $address?->zip_code }}<br>
                                                            Phone Number : {{ $address?->phone }}
                                                        </span>
                                                    </span>
                                                    <!-- Check Icon (hidden by default) -->
                                                    <i data-lucide="check"
                                                        class="size-5 text-primary-600 hidden absolute top-4 right-4 pointer-events-none"></i>
                                                </label>
                                            @empty
                                                <p class="text-gray-500">No saved addresses found.</p>
                                            @endforelse
                                        </div>
                                    </fieldset>
                                    <a href="{{ route('account.addresses.create') }}"
                                        class="btn-primary mt-4 !inline">Add
                                        Address</a>
                                @else
                                    @include('orders.address', [
                                        'address' => null,
                                        'countries' => App\Models\Country::all()->pluck('name', 'id'),
                                    ])
                                @endif

                                @error('address_id')
                                    <p class="mt-2 text-base text-red-600">Please Select Address to continue order.</p>
                                @enderror

                                <div class="mt-10 border-t border-gray-200 pt-10">
                                    <h2 class="text-2xl font-semibold text-gray-800">Payment</h2>

                                    <fieldset class="mt-4">
                                        <legend class="sr-only">Payment type</legend>
                                        <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                            <input type="hidden" name="payment_method" value="cod" />

                                            @forelse (paymentGateways() as $paymentGateway)
                                                <div class="flex items-center">
                                                    <input id="{{ $paymentGateway['name'] }}" name="payment_method"
                                                        type="radio" class="form-radio"
                                                        value="{{ $paymentGateway['name'] }}"
                                                        {{ $loop->first ? 'checked' : '' }} />
                                                    <label for="{{ $paymentGateway['name'] }}"
                                                        class="ml-3 block text-base/6 font-medium text-gray-700">{{ $paymentGateway['description'] }}</label>
                                                </div>
                                            @empty
                                                <div class="flex items-center">
                                                    <input id="cod" name="payment_method" type="radio"
                                                        class="form-radio" value="cod" checked />
                                                    <label for="cod"
                                                        class="ml-3 block text-base/6 font-medium text-gray-700">Cash
                                                        on
                                                        Delivery</label>
                                                </div>
                                            @endforelse
                                        </div>
                                    </fieldset>
                                </div>

                                <div>
                                    <label for="notes" class="control-label">Notes</label>
                                    <textarea id="notes" name="notes" class="form-control mt-2" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 mt-6 lg:mt-0">
                        <div class="rounded-xl bg-white shadow-xs border border-gray-200">
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
                                        <dt class="text-base/6 text-gray-600">Delivery Charge</dt>
                                        <dd class="text-base/6 font-bold text-gray-900"
                                            x-text="formatCurrency(deliveryCharge)"></dd>
                                    </div>
                                    <template x-for="tax in taxes" :key="tax.name">
                                        <div class="flex items-center justify-between">
                                            <dt class="text-base/6 text-gray-600" x-text="tax.name"></dt>
                                            <dd class="text-base/6 font-medium text-gray-900"
                                                x-text="tax.amount_display"></dd>
                                        </div>
                                    </template>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                        <dd class="text-base/6 font-bold text-gray-900"
                                            x-text="formatCurrency(grandTotal)"></dd>
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

            var stateId = "{{ old('address.state_id', setting('company.state')) }}";

            function checkoutTax() {
                return {
                    addressId: "{{ auth()->user()?->defaultAddress?->id }}",
                    taxes: [],
                    state_id: stateId,
                    subTotal: {{ cart()->total }},
                    deliveryCharge: {{ getDeliveryCharge() }},
                    totalTax: 0,
                    grandTotal() {
                        return this.subTotal + this.deliveryCharge + this.totalTax;
                    },
                    fetchTaxes() {
                        axios.get("{{ route('account.checkout.taxes') }}", {
                                params: {
                                    address_id: this.addressId,
                                    state_id: this.state_id
                                }
                            })
                            .then(response => {
                                this.taxes = response.data.taxes;
                                this.totalTax = response.data.total_tax;

                                this.grandTotal = this.subTotal + this.totalTax + this.deliveryCharge;
                            })
                            .catch(error => {
                                console.error("Tax fetch error:", error);
                            });
                    },
                    formatCurrency(value) {
                        return value.toLocaleString('en-US', {
                            style: 'currency',
                            currency: '{{ app_country()->currency }}'
                        });
                    }
                }
            }
        </script>
    @endpush
</x-layouts.front>
