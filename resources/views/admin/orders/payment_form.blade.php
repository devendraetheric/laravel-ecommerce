<form method="post" action="{{ route('admin.payments.store', $order) }}">
    @csrf

    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-800">Record Payment</h3>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-4">

                <div class="space-y-2">
                    <label for="payment_number" class="control-label">Payment Number</label>
                    <input type="text" name="payment_number" id="payment_number"
                        class="form-control @error('payment_number') is-invalid @enderror"
                        value="{{ old('payment_number', $payment->payment_number ?? $payment->generatePaymentNumber()) }}"
                        readonly />
                    @error('payment_number')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="reference" class="control-label">Reference</label>
                    <input type="text" name="reference" id="reference"
                        class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}" />
                    @error('reference')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="amount" class="control-label">Amount</label>
                    <input type="text" name="amount" id="amount"
                        class="form-control @error('amount') is-invalid @enderror"
                        value="{{ old('amount', $order->grand_total - $order->paid_amount) }}" />
                    @error('amount')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 col-span-3 md:col-span-1">
                    <label for="method" class="control-label">Method</label>
                    <select name="method" id="method" class="form-select @error('method') is-invalid @enderror">
                        <option value="">Select method</option>
                        @foreach (\App\Enums\PaymentType::cases() as $method)
                            <option value="{{ $method->value }}" @selected(old('method', $order->method->value ?? 'cash') == $method->value)>
                                {{ $method->label() }}
                            </option>
                        @endforeach
                    </select>

                    @error('method')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 col-span-2 md:col-span-2">
                    <label for="notes" class="control-label">Note</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn-primary mt-6">Submit</button>
</form>
