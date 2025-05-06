<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.products.index'),
                    'text' => 'Products',
                ],
                [
                    'text' => 'Import',
                ],
            ];
            $title = 'Import Product';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.products.index')" />


        <form method="post" action="{{ route('admin.products.import.store') }}">
            @csrf

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Import Product</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label for="sku" class="control-label">SKU</label>
                            <input type="text" name="sku" id="sku"
                                class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}"
                                required />
                            @error('sku')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="barcode" class="control-label">Barcode</label>
                            <input type="text" name="barcode" id="barcode"
                                class="form-control @error('barcode') is-invalid @enderror" value="{{ old('barcode') }}"
                                required />
                            @error('barcode')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="price" class="control-label">Price</label>
                            <input type="text" name="price" id="price"
                                class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                                required />
                            @error('price')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-primary mt-6">Submit</button>
        </form>
    </div>

</x-layouts.admin>
