<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.coupons.index'),
                    'text' => 'Coupons',
                ],
                [
                    'text' => $coupon->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $coupon->id ? 'Edit ' . $coupon->code : 'Create Coupon';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.coupons.index')" />

        <form method="post"
            action="{{ $coupon->id ? route('admin.coupons.update', $coupon) : route('admin.coupons.store') }}">
            @csrf

            @isset($coupon->id)
                @method('put')
            @endisset
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="code" class="control-label sm:pt-1.5">Code</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code', $coupon->code) }}" />
                            @error('code')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="total_quantity" class="control-label sm:pt-1.5">Total Quantity</label>
                            <input type="text" name="total_quantity" id="total_quantity"
                                class="form-control @error('total_quantity') is-invalid @enderror"
                                value="{{ old('total_quantity', $coupon->total_quantity) }}" />
                            @error('total_quantity')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>




                        <div class="space-y-2 col-span-2">
                            <label for="description" class="control-label sm:pt-1.5">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description', $coupon->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="start_date" class="control-label sm:pt-1.5">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date', $coupon->start_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                            @error('start_date')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="end_date" class="control-label sm:pt-1.5">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="form-control @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date', $coupon->end_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                            @error('end_date')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="type" class="control-label sm:pt-1.5">Type</label>
                            <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                    <select name="type" id="type"
                                        class="col-start-1 row-start-1 form-select @error('type') is-invalid @enderror">
                                        <option value="flat" @selected(old('type', $coupon->type) == 'flat')>Flat</option>
                                        <option value="percent" @selected(old('type', $coupon->type) == 'percent')>Percent</option>
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('type')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="value" class="control-label sm:pt-1.5">Value</label>
                            <input type="text" name="value" id="value"
                                class="form-control @error('value') is-invalid @enderror"
                                value="{{ old('value', $coupon->value) }}" />
                            @error('value')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="total_quantity" class="control-label sm:pt-1.5">Total Quantity</label>
                            <input type="text" name="total_quantity" id="total_quantity"
                                class="form-control @error('total_quantity') is-invalid @enderror"
                                value="{{ old('total_quantity', $coupon->total_quantity) }}" />
                            @error('total_quantity')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="use_per_user" class="control-label sm:pt-1.5">Use Per User</label>
                            <input type="text" name="use_per_user" id="use_per_user"
                                class="form-control @error('use_per_user') is-invalid @enderror"
                                value="{{ old('use_per_user', $coupon->use_per_user) }}" />
                            @error('use_per_user')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="used_quantity" class="control-label sm:pt-1.5">Used Quantity</label>
                            <input type="text" name="used_quantity" id="used_quantity"
                                class="form-control @error('used_quantity') is-invalid @enderror"
                                value="{{ old('used_quantity', $coupon->used_quantity) }}" />
                            @error('used_quantity')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="max_discount_value" class="control-label sm:pt-1.5">Max Discount Value</label>
                            <input type="text" name="max_discount_value" id="max_discount_value"
                                class="form-control @error('max_discount_value') is-invalid @enderror"
                                value="{{ old('max_discount_value', $coupon->max_discount_value) }}" />
                            @error('max_discount_value')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="min_cart_value" class="control-label sm:pt-1.5">Min Cart Value</label>
                            <input type="text" name="min_cart_value" id="min_cart_value"
                                class="form-control @error('min_cart_value') is-invalid @enderror"
                                value="{{ old('min_cart_value', $coupon->min_cart_value) }}" />
                            @error('min_cart_value')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="max_cart_value" class="control-label sm:pt-1.5">Max Cart Value</label>
                            <input type="text" name="max_cart_value" id="max_cart_value"
                                class="form-control @error('max_cart_value') is-invalid @enderror"
                                value="{{ old('max_cart_value', $coupon->max_cart_value) }}" />
                            @error('max_cart_value')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="is_for_new_user" class="control-label sm:pt-1.5">Is For New User</label>
                            <input type="text" name="is_for_new_user" id="is_for_new_user"
                                class="form-control @error('is_for_new_user') is-invalid @enderror"
                                value="{{ old('is_for_new_user', $coupon->is_for_new_user) }}" />
                            @error('is_for_new_user')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
