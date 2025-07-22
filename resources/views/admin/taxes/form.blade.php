<x-layouts.admin>
    <div class="max-w-7xl mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.taxes.index'),
                    'text' => 'Taxes',
                ],
                [
                    'text' => $tax->id ? 'Edit' : 'Create',
                ],
            ];

            $title = $tax->id ? 'Edit ' . $tax->name : 'Create Tax';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.taxes.index')" />

        <form method="post" action="{{ $tax->id ? route('admin.taxes.update', $tax) : route('admin.taxes.store') }}">
            @csrf

            @isset($tax->id)
                @method('put')
            @endisset

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $tax->name) }}"
                                class="form-control @error('name') is-invalid @enderror" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="type" class="control-label">Type</label>
                            <select name="type" id="type"
                                class="form-select @error('type') is-invalid @enderror">
                                @foreach (\App\Enums\TaxType::cases() as $method)
                                    <option value="{{ $method->value }}" @selected(old('type', $tax->type ?? 'default') == $method->value)>
                                        {{ $method->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="rate" class="control-label">Rate</label>
                            <input type="text" name="rate" id="rate" value="{{ old('rate', $tax->rate) }}"
                                class="form-control @error('rate') is-invalid @enderror" />
                            @error('rate')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.taxes.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
