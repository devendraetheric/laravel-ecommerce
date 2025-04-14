<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- css link here  -->
    @vite(['node_modules/swiper/swiper.min.css', 'resources/css/app.css'])
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
