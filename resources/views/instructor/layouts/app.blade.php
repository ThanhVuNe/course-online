<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

        @vite(['resources/scss/instructor.scss', 'resources/js/app.js'])
        <link href="{{ asset('assets/css/instructor/style.css') }} " rel="stylesheet">

        @yield('style')
        <title> @yield('title') </title>
</head>

<body>

    @include('instructor.layouts.header')

    @include('instructor.layouts.sidebar')

    @yield('content')

    @include('instructor.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/instructor/main.js') }}"></script>
    @yield('script')
</body>

</html>
