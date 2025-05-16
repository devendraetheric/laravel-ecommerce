<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Profile',
                ],
                [
                    'text' => 'Edit',
                ],
            ];
            $title = 'Edit ' . $user->name;
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.dashboard')" />


        <div class="grid gap-6 grid-cols-2">

            <form method="post" action="{{ route('admin.profile.update', $user) }}">
                @csrf
                @method('put')

                <div class="mt-6 rounded-xl bg-white shadow-sm">
                    <div class="p-6">
                        <div class="grid gap-4">
                            <div class="space-y-2">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-x-2">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    <a href="#" class="btn-secondary">Cancel</a>
                </div>

            </form>

            <!--------Password --------->
            <form method="post" action="{{ route('admin.profile.password') }}">
                @csrf
                @method('put')

                <div class="mt-6 rounded-xl bg-white shadow-sm">
                    <div class="p-6">

                        <div class="grid gap-4">
                            <div class="space-y-2">
                                <label for="update_password_current_password" class="control-label">
                                    Current Password
                                </label>
                                <input type="password" name="current_password" id="update_password_current_password"
                                    value="{{ old('current_password') }}"
                                    class="form-control  @error('current_password', 'updatePassword') is-invalid @enderror" />
                                @error('current_password', 'updatePassword')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="space-y-2">
                                <label for="update_password_password" class="control-label">New Password</label>
                                <input type="password" name="password" id="update_password_password"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('password') }}"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror" />
                                @error('password', 'updatePassword')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="space-y-2">
                                <label for="update_password_password_confirmation" class="control-label">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="update_password_password"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    value="{{ old('password_confirmation') }}"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror" />
                                @error('password_confirmation', 'updatePassword')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-6 space-x-2">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    <a href="#" class="btn-secondary">Cancel</a>
                </div>
            </form>

        </div>
    </div>

</x-layouts.admin>
