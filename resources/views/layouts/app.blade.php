<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta-tags', View::make('layouts.common.meta-tag'))
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/brand.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;family=Lora:wght@400;700&amp;family=Montserrat:wght@400;500;600;700&amp;family=Nunito:wght@400;700&amp;display=swap"
        rel="stylesheet">

    <!-- Theme CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    @yield('style')
    <title> @yield('title') </title>
</head>

<body class="bg-white">
    @yield('modal')
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <!-- Theme JS -->
    <script type="module" src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/badge.js') }}"></script>
    @yield('script')
</body>

</html>
