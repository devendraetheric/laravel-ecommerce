<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Account'],
                ['url' => route('account.addresses.index'), 'text' => 'Your Addresses'],
                ['url' => '#', 'text' => 'Add a new Address'],
            ],
            'title' => 'Add a new Address',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <x-account.nav />

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl/6 font-semibold text-gray-800">Address Information</h3>
                </div>
                <div class="p-6 ">
                    <form
                        action="{{ $address->id ? route('account.addresses.update', $address) : route('account.addresses.store') }}"
                        method="POST" class="space-y-6" x-data="addressInfo()">
                        @csrf

                        @isset($address->id)
                            @method('put')
                        @endisset

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-base/6 font-medium text-gray-600">Address
                                    Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $address->name) }}" class="form-control mt-2" />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="country_id"
                                    class="block text-base/6 font-medium text-gray-600">Country</label>
                                <div class="mt-2 grid grid-cols-1">
                                    <select id="country_id" name="country_id"
                                        class="col-start-1 row-start-1 w-full appearance-none rounded-lg bg-gray-50 py-4 pr-10 pl-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6"
                                        x-model="country_id" x-init="countryChange()" @change="countryChange()">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $key => $country)
                                            <option value="{{ $key }}" @selected(old('country_id', $address->country_id ?? 233) == $key)>
                                                {{ $country }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @error('country_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_name" class="block text-base/6 font-medium text-gray-600">Full
                                    Name</label>
                                <input type="text" id="contact_name" name="contact_name"
                                    value="{{ old('contact_name', $address->contact_name ?? auth()->user()->name) }}"
                                    class="form-control mt-2" />
                                @error('contact_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-base/6 font-medium text-gray-600">Phone</label>
                                <input type="text" id="phone" name="phone"
                                    value="{{ old('phone', $address->phone ?? auth()->user()->phone) }}"
                                    class="form-control mt-2" />
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="address_line_1" class="block text-base/6 font-medium text-gray-600">Address
                                    Line 1</label>
                                <input type="text" id="address_line_1" name="address_line_1"
                                    value="{{ old('address_line_1', $address->address_line_1) }}"
                                    class="form-control mt-2" placeholder="Street address or P.O. Box" />
                                @error('address_line_1')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="address_line_2" class="block text-base/6 font-medium text-gray-600">Address
                                    Line 2</label>
                                <input type="text" id="address_line_2" name="address_line_2"
                                    value="{{ old('address_line_2', $address->address_line_2) }}"
                                    class="form-control mt-2" placeholder="Apt,suite,unit,building,floor,etc." />
                                @error('address_line_2')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-base/6 font-medium text-gray-600">City</label>
                                <input type="text" id="city" name="city"
                                    value="{{ old('city', $address->city) }}" class="form-control mt-2" />
                                @error('city')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="state_id" class="block text-base/6 font-medium text-gray-600">State</label>
                                <div class="mt-2 grid grid-cols-1">
                                    <select x-model="state_id" id="state_id" name="state_id"
                                        class="col-start-1 row-start-1 w-full appearance-none rounded-lg bg-gray-50 py-4 pr-10 pl-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6">
                                        <option value="">Select State</option>
                                        <template x-for="(state,key) in states" :key="state">
                                            <option :value="state" x-text="key"></option>
                                        </template>
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @error('state_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="zip_code" class="block text-base/6 font-medium text-gray-600">Zip
                                    Code</label>
                                <input type="text" id="zip_code" name="zip_code"
                                    value="{{ old('zip_code', $address->zip_code) }}" class="form-control mt-2" />
                                @error('zip_code')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="is_default" value="0" />
                        <div class="flex gap-3 items-center">
                            <div class="flex h-5 shrink-0 items-center">
                                <div class="group grid size-5 grid-cols-1">
                                    <input id="is_default" name="is_default" type="checkbox"
                                        class="col-start-1 row-start-1 form-checkbox" value="1"
                                        @checked(old('is_default', $address->is_default)) />
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                        viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <label for="is_default" class="block text-base/6 text-gray-900">Default Address</label>
                        </div>

                        <button type="submit" class="btn-primary">Save Address</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            var stateId = "{{ old('state_id', $address->state_id ?? 1460) }}";

            function addressInfo() {
                return {
                    country_id: "{{ old('country_id', $address->country_id ?? 233) }}",
                    state_id: "",
                    states: [],

                    async countryChange() {

                        if (this.country_id) {
                            try {
                                const response = await axios.post("{{ route('fetchState') }}", {
                                    country_id: this.country_id,
                                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                });

                                this.states = response.data;

                                if (stateId) {
                                    this.state_id = stateId;
                                }

                            } catch (error) {
                                console.error('Error fetching countries:', error);
                            }
                        }
                    }
                };
            }
        </script>
    @endpush
</x-layouts.front>
