<x-guest-layout>
    <p class="mb-6">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form class="mb-6" method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button class="btn btn-primary d-grid w-100">{{ __('Resend Verification Email') }}</button>
    </form>

    <form class="text-center" method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="btn btn-link">
            <i class="bx bx-chevron-left scaleX-n1-rtl me-1"></i>
            {{ __('Back to login') }}
        </button>
    </form>
</x-guest-layout>
