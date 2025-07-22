<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Reset Password']],
            'title' => 'Reset Password',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- Reset Password Form Start -->
    <div class="container py-20">

        <div class="w-full lg:w-1/2 bg-white shadow-xs rounded-xl border border-gray-200 mx-auto p-8">
            <h2 class="text-center text-gray-800 xl:text-4xl text-xl font-bold mb-10">Reset Password</h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="space-y-2.5">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email', $request->email) }}"
                        placeholder="Email" class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2.5">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" />
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2.5">
                    <label for="password_confirmation" class="control-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password"
                        class="form-control @error('password_confirmation') is-invalid @enderror" />
                    @error('password_confirmation')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-common.captcha />

                <button type="submit" class="btn-primary w-full gap-x-2">
                    {{ __('Reset Password') }}
                    <i data-lucide="move-right" class="size-6"></i>
                </button>
            </form>


            <p class="font-normal text-base leading-tight text-gray-800 mt-6 text-center">
                <a href="{{ route('login') }}" class="text-primary-600 font-medium text-base leading-tight">
                    {{ __('Back to login') }}</a>
            </p>

        </div>
    </div>
    <!-- Sign In Form End -->

</x-layouts.front>
