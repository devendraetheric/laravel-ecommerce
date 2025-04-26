<x-layouts.admin>

    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.prefix'),
                    'text' => 'Prefix Settings',
                ],
            ];

            $title = 'Prefix Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />

        <form method="post" action="{{ route('admin.settings.savePrefix') }}">

            @csrf

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-800">Order Prefix</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-4">

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="order_prefix" class="control-label sm:pt-1.5">Prefix</label>
                                <input type="text" name="order_prefix" id="order_prefix"
                                    class="form-control @error('order_prefix') is-invalid @enderror"
                                    value="{{ old('order_prefix', $settings->order_prefix) }}" />
                                @error('order_prefix')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="order_digit_length" class="control-label sm:pt-1.5">Digit Length</label>
                                <input type="text" name="order_digit_length" id="order_digit_length"
                                    class="form-control @error('order_digit_length') is-invalid @enderror"
                                    value="{{ old('order_digit_length', $settings->order_digit_length) }}" />
                                @error('order_digit_length')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="order_sequence" class="control-label sm:pt-1.5">Sequence</label>
                                <input type="text" name="order_sequence" id="order_sequence"
                                    class="form-control @error('order_sequence') is-invalid @enderror"
                                    value="{{ old('order_sequence', $settings->order_sequence) }}" />
                                @error('order_sequence')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-800">Payment Prefix</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-4">

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="payment_prefix" class="control-label sm:pt-1.5">Prefix</label>
                                <input type="text" name="payment_prefix" id="payment_prefix"
                                    class="form-control @error('payment_prefix') is-invalid @enderror"
                                    value="{{ old('payment_prefix', $settings->payment_prefix) }}" />
                                @error('payment_prefix')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="payment_digit_length" class="control-label sm:pt-1.5">Digit Length</label>
                                <input type="text" name="payment_digit_length" id="payment_digit_length"
                                    class="form-control @error('payment_digit_length') is-invalid @enderror"
                                    value="{{ old('payment_digit_length', $settings->payment_digit_length) }}" />
                                @error('payment_digit_length')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 col-span-2 md:col-span-1">
                                <label for="payment_sequence" class="control-label sm:pt-1.5">Sequence</label>
                                <input type="text" name="payment_sequence" id="payment_sequence"
                                    class="form-control @error('payment_sequence') is-invalid @enderror"
                                    value="{{ old('payment_sequence', $settings->payment_sequence) }}" />
                                @error('payment_sequence')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.settings.socialMedia') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
