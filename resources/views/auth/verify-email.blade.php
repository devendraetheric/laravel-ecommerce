<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Email Verification']],
            'title' => 'Email Verification',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="container py-20">

        <div class="w-full lg:w-1/2 bg-white shadow-lg rounded-xl mx-auto p-8">
            <h2 class="text-center text-gray-800 xl:text-4xl text-xl font-bold mb-10">{{ __('Email Verification') }}</h2>

            <div class="mx-12">
                <p class="mb-6 text-gray-600 text-base/6 text-center">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="text-center text-green-400 mb-4">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
                @csrf

                <button type="submit" class="btn-primary w-full gap-x-2">
                    {{ __('Resend Verification Email') }}
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7.5L20.5 12M20.5 12L16 16.5M20.5 12H4.5" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>

            <form class="text-center mt-6" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-primary-600 font-medium text-base leading-tight cursor-pointer">
                    {{ __('Back to login') }}
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 7.5L4.5 12M4.5 12L9 16.5M4.5 12H20.5" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

</x-layouts.front>
