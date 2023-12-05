<!-- PAGE TITLE
================================================== -->
<header class="py-8 py-md-11 mb-5 overlay overlay-primary overlay-80" style="background-image: url({{ asset('assets/img/covers/cover-19.jpg')}} )">
    <div class="container text-center py-xl-2">
        <h1 class="display-4 fw-semi-bold mb-0 text-white">{{ __('my_courses') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">
                        {{ __('home') }}
                    </a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">
                    {{ __('my_courses') }}
                </li>
            </ol>
        </nav>
    </div>
</header>

<!-- NAVBAR COURSE
================================================== -->
<div class="container">
    <!-- Nav -->
    <ul class="nav justify-content-center course-tab-v1 border-bottom h4 mb-8">
        <li class="nav-item">
            <a href="#" class="nav-link active" data-bs-toggle="pill" data-filter="*" data-target="#gallery">
                {{ __('all_courses') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="pill" data-filter=".business" data-target="#gallery">
                {{ __('my_list') }}(To do)
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="pill" data-filter=".design" data-target="#gallery">
                {{ __('tools') }}(To do)
            </a>
        </li>
    </ul>
</div>
