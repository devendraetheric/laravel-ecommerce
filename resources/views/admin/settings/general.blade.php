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
                                class="form-control @error('app_name') is-invalid @enderror"
                                value="{{ old('app_name', $settings->app_name) }}" />
                            @error('app_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="site_name" class="control-label sm:pt-1.5">Site Name</label>
                            <input type="text" name="site_name" id="site_name"
                                class="form-control @error('site_name') is-invalid @enderror"
                                value="{{ old('site_name', $settings->site_name) }}" />
                            @error('site_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="space-y-2 col-span-2">
                            <label for="site_description" class="control-label sm:pt-1.5">Site Description</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" id="site_description"
                                name="site_description" rows="2">{{ old('site_description', $settings->site_description) }}</textarea>
                            @error('site_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="date_format" class="block text-base/6 font-medium text-gray-600">Date
                                Format</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="date_format" name="date_format" class="col-start-1 row-start-1 form-select">
                                    <option value="">Select Date Format</option>
                                    @foreach ($dateFormats as $key => $dateFormat)
                                        <option value="{{ $key }}" @selected(old('date_format', $settings->date_format) == $key)>
                                            ({{ $key }})
                                            {{ $dateFormat }}
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
                            @error('date_format')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="time_format" class="block text-base/6 font-medium text-gray-600">Time
                                Format</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="time_format" name="time_format" class="col-start-1 row-start-1 form-select">
                                    <option value="">Select Time Format</option>
                                    @foreach ($timeFormats as $key => $timeFormat)
                                        <option value="{{ $key }}" @selected(old('time_format', $settings->time_format) == $key)>
                                            ({{ $key }})
                                            {{ $timeFormat }}
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
                            @error('time_format')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="timezone" class="block text-base/6 font-medium text-gray-600">Time Zone</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="timezone" name="timezone" class="col-start-1 row-start-1 form-select">
                                    <option value="">Select Time Zone</option>
                                    @foreach ($timezones as $key => $timezone)
                                        <option value="{{ $timezone }}" @selected(old('timezone', $settings->timezone) == $timezone)>
                                            {{ $timezone }}
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
                            @error('timezone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
