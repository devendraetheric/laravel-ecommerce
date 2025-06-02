<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.company'),
                    'text' => 'Company Settings',
                ],
            ];

            $title = 'Company Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.store') }}">
            @csrf

            <input type="hidden" name="group_name" value="company" />
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6" x-data="companyAddressInfo()">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="name" class="control-label">Name</label>
                                <span class="text-sm/6 text-gray-500" id="name-optional">setting('company.name')</span>
                            </div>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $settings->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="email" class="control-label">Email</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="email-optional">setting('company.email')</span>
                            </div>
                            <input type="text" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $settings->email) }}" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="phone" class="control-label">Phone</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="phone-optional">setting('company.phone')</span>
                            </div>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $settings->phone) }}" />
                            @error('phone')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="website" class="control-label">Website</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="website-optional">setting('company.website')</span>
                            </div>
                            <input type="text" name="website" id="website"
                                class="form-control @error('website') is-invalid @enderror"
                                value="{{ old('website', $settings->website) }}" />
                            @error('website')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-full">
                            <div class="flex justify-between">
                                <label for="address" class="control-label">Address</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="address-optional">setting('company.address')</span>
                            </div>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $settings->address) }}</textarea>
                            @error('address')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="country" class="control-label">Country</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="country-optional">setting('company.country')</span>
                            </div>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="country" name="country" class="col-start-1 row-start-1 form-select"
                                    x-model="country" x-init="countryChange()" @change="countryChange()">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $key => $country)
                                        <option value="{{ $key }}" @selected(old('country', $address->country_id ?? 233) == $key)>
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
                            @error('country')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="state" class="control-label">State</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="state-optional">setting('company.state')</span>
                            </div>
                            <div class="mt-2 grid grid-cols-1">
                                <select x-model="state" id="state" name="state"
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
                            @error('state')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="city" class="control-label">City</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="city-optional">setting('company.city')</span>
                            </div>
                            <input type="text" name="city" id="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $settings->city) }}" />
                            @error('city')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="zipcode" class="control-label">Zipcode</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="zipcode-optional">setting('company.zipcode')</span>
                            </div>
                            <input type="text" name="zipcode" id="zipcode"
                                class="form-control @error('zipcode') is-invalid @enderror"
                                value="{{ old('zipcode', $settings->zipcode) }}" />
                            @error('zipcode')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary mt-6">Save Changes</button>
        </form>
    </div>


    @push('scripts')
        <script>
            var stateId = "{{ old('state', $settings->state) }}";

            function companyAddressInfo() {
                return {
                    country: "{{ old('country', $settings->country) }}",
                    state: "",
                    states: [],

                    async countryChange() {

                        if (this.country) {
                            try {
                                const response = await axios.post("{{ route('fetchState') }}", {
                                    country_id: this.country,
                                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                });

                                this.states = response.data;

                                if (stateId) {
                                    this.state = stateId;
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
</x-layouts.admin>
