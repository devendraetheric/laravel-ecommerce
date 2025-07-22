<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Sign In']],
            'title' => 'Sign In',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- Sign In Form Start -->
    <div class="container py-20">

        <div class="w-full lg:w-1/2 bg-white shadow-xs rounded-xl border border-gray-200 mx-auto p-8">
            <h2 class="text-center text-gray-800 xl:text-4xl text-xl font-bold mb-10">Sign In</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2.5">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" />
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

                <div class="flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="form-checkbox size-5" />
                        <label for="remember-me" class="control-label">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-primary-600 text-base font-medium leading-tight"
                            href="{{ route('password.request') }}">
                            <span>{{ __('Forgot your password?') }}</span>
                        </a>
                    @endif
                </div>

                <x-common.captcha />

                <button type="submit" class="btn-primary w-full gap-x-2">
                    Sign In
                    <i data-lucide="move-right" class="size-6"></i>
                </button>
            </form>

            @if (Route::has('register'))
                <p class="font-normal text-base/tight text-gray-800 mt-6 text-center">
                    Don't have account?
                    <a href="{{ route('register') }}" class="text-primary-600 font-medium text-base/tight">
                        Sign Up</a>
                </p>
            @endif
        </div>
    </div>
    <!-- Sign In Form End -->
</x-layouts.front>
