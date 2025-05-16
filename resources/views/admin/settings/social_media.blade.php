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
                    'text' => 'Social Media Links',
                ],
            ];

            $title = 'Social Media Links';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.saveSocialMedia') }}">

            @csrf

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="facebook" class="control-label">Facebook</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="facebook-optional">setting('social.facebook')</span>
                            </div>
                            <input type="text" name="facebook" id="facebook"
                                class="form-control @error('facebook') is-invalid @enderror"
                                value="{{ old('facebook', $settings->facebook) }}" />
                            @error('facebook')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="instagram" class="control-label">Instagram</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="instagram-optional">setting('social.instagram')</span>
                            </div>
                            <input type="text" name="instagram" id="instagram"
                                class="form-control @error('instagram') is-invalid @enderror"
                                value="{{ old('instagram', $settings->instagram) }}" />
                            @error('instagram')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="youtube" class="control-label">YouTube</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="youtube-optional">setting('social.youtube')</span>
                            </div>
                            <input type="text" name="youtube" id="youtube"
                                class="form-control @error('youtube') is-invalid @enderror"
                                value="{{ old('youtube', $settings->youtube) }}" />
                            @error('youtube')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="twitter" class="control-label">Twitter</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="twitter-optional">setting('social.twitter')</span>
                            </div>
                            <input type="text" name="twitter" id="twitter"
                                class="form-control @error('twitter') is-invalid @enderror"
                                value="{{ old('twitter', $settings->twitter) }}" />
                            @error('twitter')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.settings.socialMedia') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
