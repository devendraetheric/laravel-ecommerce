<div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-base font-semibold text-gray-800">Address Information</h3>
    </div>
    <div class="p-6 space-y-6" x-data="addressInfo()">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="control-label">Address
                    Name</label>
                <input type="text" id="name" name="address[name]"
                    value="{{ old('address.name', $address?->name) }}"
                    class="form-control mt-2 @error('address.name') is-invalid @enderror" />
                @error('address.name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="country_id" class="control-label">Country</label>
                <div class="mt-2 grid grid-cols-1">
                    <select id="country_id" name="address[country_id]" class="col-start-1 row-start-1 form-select"
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
                @error('address.country_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="contact_name" class="control-label">Full
                    Name</label>
                <input type="text" id="contact_name" name="address[contact_name]"
                    value="{{ old('address.contact_name', $address?->contact_name) }}"
                    class="form-control mt-2 @error('address.contact_name') is-invalid @enderror" />
                @error('address.contact_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="control-label">Phone</label>
                <input type="text" id="phone" name="address[phone]"
                    value="{{ old('address.phone', $address?->phone) }}"
                    class="form-control mt-2 @error('address.phone') is-invalid @enderror" />
                @error('address.phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="address_line_1" class="control-label">Address
                    Line 1</label>
                <input type="text" id="address_line_1" name="address[address_line_1]"
                    value="{{ old('address.address_line_1', $address?->address_line_1) }}"
                    class="form-control mt-2  @error('address.address_line_1') is-invalid @enderror"
                    placeholder="Street address or P.O. Box" />
                @error('address.address_line_1')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address_line_2" class="control-label">Address
                    Line 2</label>
                <input type="text" id="address_line_2" name="address[address_line_2]"
                    value="{{ old('address.address_line_2', $address?->address_line_2) }}" class="form-control mt-2"
                    placeholder="Apt,suite,unit,building,floor,etc." />
                @error('address.address_line_2')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label for="city" class="control-label">City</label>
                <input type="text" id="city" name="address[city]"
                    value="{{ old('address.city', $address?->city) }}"
                    class="form-control mt-2 @error('address.city') is-invalid @enderror" />
                @error('address.city')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="state_id" class="control-label">State</label>
                <div class="mt-2 grid grid-cols-1">
                    <select x-model="state_id" id="state_id" name="address[state_id]"
                        class="col-start-1 row-start-1 form-select">
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
                @error('address.state_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="zip_code" class="control-label">Zip
                    Code</label>
                <input type="text" id="zip_code" name="address[zip_code]"
                    value="{{ old('address.zip_code', $address?->zip_code) }}"
                    class="form-control mt-2 @error('address.zip_code') is-invalid @enderror" />
                @error('address.zip_code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var stateId = "{{ old('address.state_id', $address->state_id ?? 1460) }}";

        function addressInfo() {
            return {
                country_id: "{{ old('address.country_id', $address->country_id ?? 233) }}",
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
                            /* console.log(this.states); */

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
