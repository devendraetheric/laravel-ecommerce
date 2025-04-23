<x-layouts.admin>


    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.general'),
                    'text' => 'General Settings',
                ],
            ];

            $title = 'General Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.saveGeneralSettings') }}" enctype="multipart/form-data">

            @csrf

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="app_name" class="control-label sm:pt-1.5">App Name</label>
                            <input type="text" name="app_name" id="app_name"
                                class="form-control @error('app_name') is-invalid @enderror" />
                            @error('app_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="tax_rate" class="control-label sm:pt-1.5">Tax Rate</label>
                            <input type="text" name="tax_rate" id="tax_rate"
                                class="form-control @error('tax_rate') is-invalid @enderror" />
                            @error('tax_rate')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="date_format" class="control-label sm:pt-1.5">Date Format</label>
                            <select class="form-select @error('date_format') is-invalid @enderror" id="date_format"
                                name="date_format" tabindex="3">
                                @foreach ($dateFormats as $key => $dateFormat)
                                    <option value="{{ $key }}" @selected(old('date_format', $settings->date_format) == $key)>
                                        ({{ $key }})
                                        {{ $dateFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('date_format')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="time_format" class="control-label sm:pt-1.5">Time Format</label>
                            <select class="form-select @error('time_format') is-invalid @enderror" id="time_format"
                                name="time_format" tabindex="4">
                                @foreach ($timeFormats as $key => $timeFormat)
                                    <option value="{{ $key }}" @selected(old('time_format', $settings->time_format) == $key)>
                                        {{ $timeFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('time_format')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="from_email" class="control-label sm:pt-1.5">From Email</label>
                            <input class="form-control @error('from_email') is-invalid @enderror" type="text"
                                id="from_email" name="from_email"
                                value="{{ old('from_email', $settings->from_email ?? '') }}" autofocus
                                tabindex="1" />
                            @error('from_email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="from_name" class="control-label sm:pt-1.5">From Email</label>
                            <input class="form-control @error('from_name') is-invalid @enderror" type="text"
                                id="from_name" name="from_name"
                                value="{{ old('from_name', $settings->from_name ?? '') }}" autofocus tabindex="1" />
                            @error('from_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>




                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.brands.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
