<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | {{ config('app.name') }}</title>


    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- favicon --}}
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" /> --}}

    <link rel="icon" type="image/png" href="{{ getFaviconURL() }}" />

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="h-full font-display">
    <x-admin.alert />
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="{{ getLogoURL() }}" alt="{{ asset('otc-logo.png') }}"
                loading="lazy" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="control-label">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            autocomplete="email" class="form-control @error('email') is-invalid @enderror" />
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="control-label">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="form-control @error('password') is-invalid @enderror">
                    </div>
                </div>

                <div class="flex gap-3 items-center">
                    <div class="flex h-4 shrink-0 items-center">
                        <div class="group grid size-4 grid-cols-1">
                            <input id="remember-me" name="remember" type="checkbox"
                                class="col-start-1 row-start-1 form-checkbox" />
                            <svg class="pointer-events-none col-start-1 row-start-1 size-4 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                viewBox="0 0 14 14" fill="none">
                                <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <label for="remember-me" class="block text-sm/tight text-gray-900">Remember me</label>
                </div>

                <div>
                    <button type="submit" class="flex w-full btn-primary justify-center">Sign in</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
