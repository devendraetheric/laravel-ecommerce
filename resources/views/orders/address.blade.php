<div class="p-6 space-y-6" x-data="addressInfo()">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label for="contact_name" class="control-label">Full
                Name</label>
            <input type="text" id="contact_name" name="address[contact_name]" value="{{ old('address.contact_name') }}"
                class="form-control @error('address.contact_name') is-invalid @enderror" />
            @error('address.contact_name')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="country_id" class="control-label">Country</label>

            <select id="country_id" name="address[country_id]"
                class="form-select @error('address.country_id') is-invalid @enderror" x-model="country_id"
                x-init="countryChange()" @change="countryChange()">
                <option value="">Select Country</option>
                @foreach ($countries as $key => $country)
                    <option value="{{ $key }}" @selected(old('country_id', setting('company.country')) == $key)>
                        {{ $country }}</option>
                @endforeach
            </select>
            @error('address.country_id')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="email" class="control-label">Email</label>
            <input type="text" id="email" name="address[email]" value="{{ old('address.email') }}"
                class="form-control @error('address.email') is-invalid @enderror" />
            @error('address.email')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="phone" class="control-label">Phone</label>
            <input type="text" id="phone" name="address[phone]" value="{{ old('address.phone') }}"
                class="form-control @error('address.phone') is-invalid @enderror" />
            @error('address.phone')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="address_line_1" class="control-label">Address
                Line 1</label>
            <input type="text" id="address_line_1" name="address[address_line_1]"
                value="{{ old('address.address_line_1') }}"
                class="form-control @error('address.address_line_1') is-invalid @enderror"
                placeholder="Street address or P.O. Box" />
            @error('address.address_line_1')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="address_line_2" class="control-label">Address
                Line 2</label>
            <input type="text" id="address_line_2" name="address[address_line_2]"
                value="{{ old('address.address_line_2') }}"
                class="form-control @error('address.address_line_2') is-invalid @enderror"
                placeholder="Apt,suite,unit,building,floor,etc." />
            @error('address.address_line_2')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="space-y-2">
            <label for="city" class="control-label">City</label>
            <input type="text" id="city" name="address[city]" value="{{ old('address.city') }}"
                class="form-control @error('address.city') is-invalid @enderror" />
            @error('address.city')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="state_id" class="control-label">State</label>
            <select x-model="state_id" id="state_id" name="address[state_id]"
                class="form-select @error('address.state_id') is-invalid @enderror" @change="fetchTaxes">
                <option value="">Select State</option>
                <template x-for="(state,key) in states" :key="state">
                    <option :value="state" x-text="key"></option>
                </template>
            </select>
            @error('address.state_id')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="zip_code" class="control-label">Zip
                Code</label>
            <input type="text" id="zip_code" name="address[zip_code]" value="{{ old('address.zip_code') }}"
                class="form-control @error('address.zip_code') is-invalid @enderror" />
            @error('address.zip_code')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function addressInfo() {
            return {
                country_id: "{{ old('address.country_id', setting('company.country')) }}",
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
                                this.$dispatch('state-changed', stateId);
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
