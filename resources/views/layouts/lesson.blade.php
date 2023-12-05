<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/brand.svg') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;family=Lora:wght@400;700&amp;family=Montserrat:wght@400;500;600;700&amp;family=Nunito:wght@400;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Theme CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/scrollbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @yield('style')
    <title> @yield('title') </title>
</head>

<body class="bg-dark">
    @yield('modal')
    <!-- NAVBAR ================================================== -->
    <header class="bg-portgore py-3">
        <div class="px-5 px-lg-8 w-100">
            <div class="d-md-flex align-items-center">
                <!-- Brand -->
                <a class="navbar-brand mb-2 mb-md-0" href="index.html">
                    <img src="{{ asset('assets/img/brand-white.svg') }}" class="navbar-brand-img" alt="...">
                </a>

                <!-- Lesson Title -->
                <div class="mx-auto mb-5 mb-md-0">
                    <h3 class="mb-0 line-clamp-2 text-white">
                        {{ $lesson['title'] }}
                    </h3>
                </div>

                <!-- Back to Course -->
                <a href="course-single-v1.html"
                    class="btn btn-sm btn-orange ms-md-6 px-6 mb-3 mb-md-0 flex-shrink-0">Back
                    to Course</a>
            </div>
        </div>
    </header>

    @yield('content')


    <!-- Theme JS -->
    <script type="module" src="{{ asset('assets/js/theme.min.js') }}"></script>
    @yield('script')
</body>

</html>
