<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.banners.index'),
                    'text' => 'Banners',
                ],
                [
                    'text' => $banner->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $banner->id ? 'Edit ' . $banner->name : 'Create Banner';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.banners.index')" />


        <form method="post"
            action="{{ $banner->id ? route('admin.banners.update', $banner) : route('admin.banners.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($banner->id)
                @method('put')
            @endisset

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="name" class="control-label sm:pt-1.5">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $banner->name) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="image" class="control-label sm:pt-1.5">Image</label>
                            <input id="image" name="image" type="file" class="form-control">
                        </div>


                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="link" class="control-label sm:pt-1.5">Link</label>
                            <input type="text" name="link" id="link"
                                class="form-control @error('link') is-invalid @enderror"
                                value="{{ old('link', $banner->link) }}" />
                            @error('link')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="location" class="control-label sm:pt-1.5">Location</label>
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $banner->location) }}" />
                            @error('location')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <script>
                                var is_active = '{{ old('is_active', $banner->is_active) }}';
                            </script>
                            <div class="flex items-center" x-data="{
                                isActive: is_active == 1 ? true : false,
                            }">
                                <button type="button" :class="isActive ? 'bg-primary-600' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 focus:outline-hidden"
                                    role="switch" :aria-checked="isActive" aria-labelledby="annual-billing-label"
                                    @click="isActive = !isActive">
                                    <span aria-hidden="true" :class="isActive ? 'translate-x-5' : 'translate-x-0'"
                                        class="pointer-events-none inline-block size-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                                <span class="ml-3 text-sm" id="annual-billing-label">
                                    <span class="font-medium text-gray-900">Is Active</span>
                                </span>
                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="is_active" :value="isActive ? 1 : 0" />
                            </div>
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <script>
                                var is_new_tab = '{{ old('is_new_tab', $banner->is_new_tab) }}';
                            </script>
                            <div class="flex items-center" x-data="{
                                isNewTab: is_new_tab == 1 ? true : false,
                            }">
                                <button type="button" :class="isNewTab ? 'bg-primary-600' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 focus:outline-hidden"
                                    role="switch" :aria-checked="isNewTab" aria-labelledby="annual-billing-label"
                                    @click="isNewTab = !isNewTab">
                                    <span aria-hidden="true" :class="isNewTab ? 'translate-x-5' : 'translate-x-0'"
                                        class="pointer-events-none inline-block size-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                                <span class="ml-3 text-sm" id="annual-billing-label">
                                    <span class="font-medium text-gray-900">Is New Tab</span>
                                </span>
                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="is_new_tab" :value="isNewTab ? 1 : 0" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.banners.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
