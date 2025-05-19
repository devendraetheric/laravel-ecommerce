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
    {{-- <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings->favicon) }}" /> --}}
    <link rel="icon" type="image/png" href="{{ getFaviconURL() }}" />

    {{-- Open Graph --}}

    <!-- css link here  -->
    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body class="font-display bg-white" x-data="{
    showMenu: false,
    openSearch: false,
    ...searchModal(),
    focusInput() {
        this.$nextTick(() => this.$refs.searchInput.focus())
    }
}" :class="{ 'overflow-hidden': openSearch || showMenu }"
    x-init="$watch('openSearch', value => {
        if (value) {
            focusInput();
        }
    })" x-on:keydown.escape.window="openSearch = false">
    <x-admin.alert />
    <x-front.header />

    {{ $slot }}

    <x-front.footer />

    <!-- script file here -->
    @vite(['resources/js/app.js'])
    @stack('scripts')

    @if (setting('general.is_captcha'))
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    @endif
</body>

</html>
