<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comforty - eCommerce HTML template</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- css link here  -->
    @vite(['node_modules/swiper/swiper.min.css', 'node_modules/select2/dist/css/select2.min.css', 'resources/css/app.css', 'resources/css/responsive.css'])
</head>

<body class="font-display">
    <x-front.header />

    {{ $slot }}

    <x-front.footer />

    <!-- script file here -->
    @vite(['node_modules/jquery/dist/jquery.min.js', 'node_modules/swiper/swiper-bundle.min.js', 'node_modules/select2/dist/js/select2.full.min.js', 'node_modules/mixitup/dist/mixitup.min.js', 'resources/js/app.js'])
</body>

</html>
