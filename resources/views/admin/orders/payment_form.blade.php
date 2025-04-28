<form method="post" action="{{ route('admin.payments.store', $order) }}">
    @csrf

    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-800">Record Payment</h3>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">

                <div class="space-y-2 col-span-2 md:col-span-1">
                    <label for="payment_number" class="control-label sm:pt-1.5">Payment Number</label>
                    <input type="text" name="payment_number" id="payment_number"
                        class="form-control @error('payment_number') is-invalid @enderror"
                        value="{{ old('payment_number', $payment->payment_number ?? $payment->generatePaymentNumber()) }}"
                        readonly />
                    @error('payment_number')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 col-span-2 md:col-span-1">
                    <label for="reference" class="control-label sm:pt-1.5">Reference</label>
                    <input type="text" name="reference" id="reference"
                        class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}" />
                    @error('reference')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 col-span-2 md:col-span-1">
                    <label for="amount" class="control-label sm:pt-1.5">Amount</label>
                    <input type="text" name="amount" id="amount"
                        class="form-control @error('amount') is-invalid @enderror"
                        value="{{ old('amount', $order->grand_total - $order->paid_amount) }}" />
                    @error('amount')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="space-y-2 col-span-2 md:col-span-1">
                    <label for="method" class="control-label sm:pt-1.5">Method</label>


                    <input type="text" name="method" id="method"
                        class="form-control @error('method') is-invalid @enderror" value="{{ old('method') }}" />
                    @error('method')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}


                <div class="space-y-2 col-span-3 md:col-span-1">
                    <label for="method" class="control-label sm:pt-1.5">Method</label>
                    <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                        <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                            <select name="method" id="method"
                                class="col-start-1 row-start-1 form-select @error('method') is-invalid @enderror">
                                <option value="">Select method</option>
                                @foreach (\App\Enums\PaymentType::cases() as $method)
                                    <option value="{{ $method->value }}" @selected(old('method', $order->method->value ?? 'cash') == $method->value)>
                                        {{ $method->label() }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @error('method')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>



                <div class="space-y-2 col-span-2 md:col-span-2">
                    <label for="notes" class="control-label sm:pt-1.5">Note</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $order->notes) }}</textarea>
                    @error('notes')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn-primary mt-6">Submit</button>
</form>
