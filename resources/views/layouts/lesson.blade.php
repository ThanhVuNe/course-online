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
    <style>
          .progress {
            height: 5px;
            background-color: #f5f5f5;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .progress-bar {
            background-color: rgb(48, 75, 172);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-dark">
    @yield('modal')
    <!-- NAVBAR ================================================== -->
    <header class="bg-portgore py-3 position-fixed" style="top: 0; right: 0; left: 0; z-index: 1000">
        <div class="px-5 px-lg-8 w-100">
            <div class="d-md-flex align-items-center">
                <!-- Brand -->
                <a class="navbar-brand mb-2 mb-md-0" href="index.html">
                    <img src="{{ asset('assets/img/brand-white.svg') }}" class="navbar-brand-img" alt="...">
                </a>

                <!-- Lesson Title -->
                <div class="mx-auto mb-5 mb-md-0">
                    <h3 class="mb-0 line-clamp-2 text-white">
                        {{ $course->title }}
                    </h3>
                    @php
                        $totalLesson = 0;
                        $totalProgress = 0;
                        $progress=0;
                        foreach ($topics as $topic) {
                            foreach ($topic->lessons as $less) {
                                if($less->processing->isNotEmpty()){
                                    $totalProgress++;
                                }
                                $totalLesson++;
                            }
                        }

                        if ($totalLesson > 0) {
                            $progress = ($totalProgress / $totalLesson) * 100;
                        }
                    @endphp
                    <div class="progress m-0">
                        <div class="progress-bar" role="progressbar" style="width: {{ round_percent($progress) }}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="m-0" style="font-size: 17px; color: navajowhite;">{{ round_percent($progress) }}% complete</p>
                </div>
                <!-- Back to Course -->
                <a href="{{ route('courses.show', ['course' => $course->id]) }}"
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
