<!DOCTYPE html>
<html lang="en">

@inject('settings', 'App\Settings\GeneralSetting')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? $settings->site_name }}</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    {{-- Meta Description --}}
    <meta name="description" content="{{ $description ?? $settings->site_description }}" />

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ request()->url() }}" />

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

    {{-- Open Graph --}}

    <!-- css link here  -->
    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body class="font-display bg-gray-50">
    <x-admin.alert />
    <x-front.header />

    {{ $slot }}

    <x-front.footer />

    <!-- script file here -->
    @vite(['resources/js/app.js'])
    @stack('scripts')

</body>

</html>
