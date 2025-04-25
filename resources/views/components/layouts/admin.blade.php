@inject('settings', 'App\Settings\GeneralSetting')
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

    @vite('resources/css/admin.css')
</head>

<body class="h-full font-display">
    <x-admin.alert />

    <div x-data="{ showSideNav: false }">

        <x-admin.sidenav />

        <div class="lg:pl-72">
            <x-admin.topnav />

            <main class="py-10 min-h-[calc(100vh-8rem)]">
                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
            <footer>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="border-t border-gray-200 py-4 text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} {{ $settings->app_name }}. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @vite('resources/js/admin.js')

    @stack('scripts')
</body>

</html>
