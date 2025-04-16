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
                        method="POST" class="space-y-6">
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
                                <input type="text" id="country_id" name="country_id"
                                    value="{{ old('country_id', $address->country_id ?? 233) }}"
                                    class="form-control mt-2" />
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
                                <input type="text" id="state_id" name="state_id"
                                    value="{{ old('state_id', $address->state_id ?? 1460) }}"
                                    class="form-control mt-2" />
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

                        <div class="flex space-x-6">
                            <button type="submit" class="btn-primary">Save Address</button>
                            <a class="btn-secondary" href="{{ route('account.addresses.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front>
