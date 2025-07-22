<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Forget Password']],
            'title' => 'Forget Password',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- Forget Password Form Start -->
    <div class="container py-20">

        <div class="w-full lg:w-1/2 bg-white shadow-xs rounded-xl border border-gray-200 mx-auto p-8">
            <h2 class="text-center text-gray-800 xl:text-4xl text-xl font-bold mb-10">Forget Password</h2>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div class="space-y-2.5">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <x-common.captcha />

                <button type="submit" class="btn-primary w-full gap-x-2">
                    {{ __('Email Password Reset Link') }}
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
