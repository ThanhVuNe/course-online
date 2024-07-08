@extends('layouts.app')
@section('title', __('page_name_course'))
@section('style')
<link rel="stylesheet" href="{{ asset('assets/libs/aos/dist/aos.css') }}">
@endsection
@section('script')
<script src="{{ asset('assets/js/courses.js') }}"></script>
<script type="module">
    $(document).ready(function () {
        $('.favorite-button').click(function () {
            console.log('click');
            var button = $(this);
            var courseId = button.data('course-id');
            var favorited = button.data('favorited') === 'true';
            var url = button.closest('form').data('url'); // Get the URL from the form data-url attribute
            button.find('.heart-animation').css('display', 'inline-block');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: $('[name="_token"]').val(), // Use the CSRF token from the page
                },
                success: function (data) {
                    var newFavorited = !favorited;
                    button.data('favorited', newFavorited.toString());
                    button.css('background-color', newFavorited ? 'red' : '');
    
                    button.find('.heart-animation').hide();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
    </script>
@endsection
@section('content')
<header class="py-8 py-lg-12 mb-8 overlay overlay-primary overlay-80"
    style="background-image: url({{ asset('assets/img/covers/cover-19.jpg') }} ); margin-top: 100px;">
    <div class="container text-center py-xl-5">
        <h1 class="display-4 fw-semi-bold mb-0 text-white">{{ __('page_name_course') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">
                        {{ __('home') }}
                    </a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">
                    {{ __('page_name_course') }}
                </li>
            </ol>
        </nav>
    </div>
    <!-- Img -->
    <img class="d-none img-fluid" src="...html" alt="...">
</header>
{{-- Recommender courses --}}
@include('common.recommend')
<!-- CONTROL BAR
                                        ================================================== -->
<div class="container mb-6 mb-xl-8 z-index-2">
    <div class="d-lg-flex align-items-center mb-6 mb-xl-0">
        <p class="mb-lg-0">{{ __('courses_available', ['total' => $courses->total()]) }}</p>
        <div class="ms-lg-auto d-lg-flex flex-wrap">
            <div class="mb-4 mb-lg-0 ms-lg-6">
                <div class="border rounded d-flex align-items-center choices-label h-50p">
                    <span class="ps-5">{{ __('sort_by') }}:</span>
                    <select id="sort-select" onchange="handleSortChange()"
                        class="form-select form-select-sm text-dark border-0 ps-1 bg-transparent flex-grow-1 shadow-none dropdown-menu-end"
                        data-choices>
                        <option value="default" @selected(request('sort')=='default' )>{{ __('sort.default') }}</option>
                        <option value="created_at:desc" @selected(request('sort')=='created_at:desc' )>{{
                            __('sort.new_courses') }}
                        </option>
                        <option value="num_reviews:desc" @selected(request('sort')=='num_reviews:desc' )>{{
                            __('sort.most_reviewed') }}
                        </option>
                        <option value="average_rating:desc" @selected(request('sort')=='average_rating:desc' )>{{
                            __('sort.highest_rated') }}
                        </option>
                        <option value="total_students:desc" @selected(request('sort')=='total_students:desc' )>
                            {{ __('sort.highest_student') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$selectedPrice = request('price', null);
$selectedDurations = request('duration', []);
$selectedRating = request('rating', null);
$selectedLevels = request('level', []);
$selectedLanguages = request('language', []);
$selectedCategories = request('category', []);
@endphp
<!-- COURSE LIST V2 ================================================== -->
<div class="container">
    <div class="row">
        <div class="col-xl-4 mb-5 mb-xl-0">
            <form action="{{ route('courses.index') }}" method="GET" id="filter-form">
                <!-- SIDEBAR FILTER================================================== -->
                <div class=" vertical-scroll" id="courseSidebar">
                    <div class="border rounded mb-6 @@widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter1">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse1"
                                    aria-expanded="false" aria-controls="coursefiltercollapse1">
                                    {{ __('languages') }}
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>

                        <div id="coursefiltercollapse1" class="collapse mt-n2 px-6 pb-6" aria-labelledby="coursefilter1"
                            data-parent="#courseSidebar">
                            <ul class="list-unstyled list-group list-checkbox">
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="languagescustomcheck1"
                                        name="language[]" value="1" @checked(in_array('1', $selectedLanguages))>
                                    <label class="custom-control-label font-size-base"
                                        for="languagescustomcheck1">English</label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="languagescustomcheck2"
                                        name="language[]" value="2" @checked(in_array('2', $selectedLanguages))>
                                    <label class="custom-control-label font-size-base"
                                        for="languagescustomcheck2">Vietnamese</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="border rounded mb-6 @@widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter2">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse2"
                                    aria-expanded="false" aria-controls="coursefiltercollapse2">
                                    Category
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>

                        <div id="coursefiltercollapse2" class="collapse mt-n2 px-6 pb-6" aria-labelledby="coursefilter2"
                            data-parent="#courseSidebar">
                            <!-- Search -->
                            <form class="mb-4">
                                <div class="input-group">
                                    <input class="form-control form-control-sm border-end-0 shadow-none" type="search"
                                        placeholder="Search(To do)" aria-label="Search">
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-sm btn-outline-white border-start-0 text-dark bg-transparent"
                                            type="submit">
                                            <!-- Icon -->
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                                    fill="currentColor" />short
                                                <path
                                                    d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </form>
                            <ul class="list-unstyled list-group list-checkbox">
                                @foreach ($categories as $category)
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="categorycustomcheck{{ $loop->index }}" name="category[]"
                                        value="{{ $category->id }}" @checked(in_array($category->id,
                                    $selectedCategories))>
                                    <label class="custom-control-label font-size-base"
                                        for="categorycustomcheck{{ $loop->index }}">{{ $category->name }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="border rounded mb-6 @@widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter3">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse3"
                                    aria-expanded="false" aria-controls="coursefiltercollapse3">
                                    {{ __('price') }}
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>
                        <div id="coursefiltercollapse3" class="collapse  mt-n2 px-6 pb-6"
                            aria-labelledby="coursefilter3" data-parent="#courseSidebar">
                            <ul class="list-unstyled list-group list-checkbox">
                                <li class="custom-control custom-radio">
                                    <input type="radio" id="pricecustomradio1" name="price" class="custom-control-input"
                                        value="all" @checked($selectedPrice=='all' )>
                                    <label class="custom-control-label font-size-base" for="pricecustomradio1">All
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" id="pricecustomradio2" name="price" class="custom-control-input"
                                        value="free" @checked($selectedPrice=='free' )>
                                    <label class="custom-control-label font-size-base" for="pricecustomradio2">Free
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" id="pricecustomradio3" name="price" class="custom-control-input"
                                        value="paid" @checked($selectedPrice=='paid' )>
                                    <label class="custom-control-label font-size-base" for="pricecustomradio3">Paid
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="border rounded mb-6 @@widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter4">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse4"
                                    aria-expanded="false" aria-controls="coursefiltercollapse4">
                                    {{ __('level') }}
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>

                        <div id="coursefiltercollapse4" class="collapse mt-n2 px-6 pb-6" aria-labelledby="coursefilter4"
                            data-parent="#courseSidebar">
                            <ul class="list-unstyled list-group list-checkbox">
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="levelcustomcheck1"
                                        name="level[]" value="1" @checked(in_array('1', $selectedLevels))>
                                    <label class="custom-control-label font-size-base" for="levelcustomcheck1">{{
                                        __('beginner') }}
                                    </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="levelcustomcheck2"
                                        name="level[]" value="2" @checked(in_array('2', $selectedLevels))>
                                    <label class="custom-control-label font-size-base" for="levelcustomcheck2">{{
                                        __('intermediate') }} </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="levelcustomcheck3"
                                        name="level[]" value="3" @checked(in_array('3', $selectedLevels))>
                                    <label class="custom-control-label font-size-base" for="levelcustomcheck3">{{
                                        __('advanced') }}
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="border rounded mb-6 @widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter5">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse5"
                                    aria-expanded="false" aria-controls="coursefiltercollapse5">
                                    {{ __('video_duration') }}
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor"></rect>
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor"></path>
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"></path>
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>

                        <div id="coursefiltercollapse5" class="collapse mt-n2 px-6 pb-6" aria-labelledby="coursefilter5"
                            data-parent="#courseSidebar">
                            <ul class="list-unstyled list-group list-checkbox">
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="durationcustomcheck1"
                                        name="duration[]" value="extraShort" @checked(in_array('extraShort',
                                        $selectedDurations))>
                                    <label class="custom-control-label font-size-base" for="durationcustomcheck1">0-1
                                        {{ __('hours') }}
                                    </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="durationcustomcheck2"
                                        name="duration[]" value="short" @checked(in_array('short', $selectedDurations))>
                                    <label class="custom-control-label font-size-base" for="durationcustomcheck2">1-3
                                        {{ __('hours') }}
                                    </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="durationcustomcheck3"
                                        name="duration[]" value="medium" @checked(in_array('medium',
                                        $selectedDurations))>
                                    <label class="custom-control-label font-size-base" for="durationcustomcheck3">3-6
                                        {{ __('hours') }}
                                    </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="ldurationcustomcheck4"
                                        name="duration[]" value="long" @checked(in_array('long', $selectedDurations))>
                                    <label class="custom-control-label font-size-base" for="ldurationcustomcheck4">6-17
                                        {{ __('hours') }}
                                    </label>
                                </li>
                                <li class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="durationcustomcheck5"
                                        name="duration[]" value="extraLong" @checked(in_array('extraLong',
                                        $selectedDurations))>
                                    <label class="custom-control-label font-size-base" for="durationcustomcheck5">17+
                                        {{ __('hours') }}
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="border rounded mb-6 @@widgetBG">
                        <!-- Heading -->
                        <div id="coursefilter6">
                            <h4 class="mb-0">
                                <button
                                    class="p-6 text-dark fw-medium d-flex align-items-center collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#coursefiltercollapse6"
                                    aria-expanded="false" aria-controls="coursefiltercollapse6">
                                    {{ __('rating') }}
                                    <span class="ms-auto text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>
                                </button>
                            </h4>
                        </div>

                        <div id="coursefiltercollapse6" class="collapse mt-n2 px-6 pb-6" aria-labelledby="coursefilter6"
                            data-parent="#courseSidebar">
                            <ul class="list-unstyled list-group list-checkbox">
                                <li class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="ratingcustomradion1"
                                        name="rating" value="4.5" @checked($selectedRating=='4.5' )>
                                    <label class="custom-control-label font-size-base" for="ratingcustomradion1">
                                        <span class="d-flex align-items-end">
                                            <span class="star-rating">
                                                <span class="rating" style="width:92%;"></span>
                                            </span>

                                            <span class="ms-3">
                                                <span>4.5 & {{ __('rating_up') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="ratingcustomradion2"
                                        name="rating" value="4" @checked($selectedRating=='4' )>
                                    <label class="custom-control-label font-size-base" for="ratingcustomradion2">
                                        <span class="d-flex align-items-end">
                                            <span class="star-rating">
                                                <span class="rating" style="width:80%;"></span>
                                            </span>

                                            <span class="ms-3">
                                                <span>4.0 & {{ __('rating_up') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="ratingcustomradion3"
                                        name="rating" value="3.5" @checked($selectedRating=='3.5' )>
                                    <label class="custom-control-label font-size-base" for="ratingcustomradion3">
                                        <span class="d-flex align-items-end">
                                            <span class="star-rating">
                                                <span class="rating" style="width:72%;"></span>
                                            </span>

                                            <span class="ms-3">
                                                <span>3.5 & {{ __('rating_up') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="ratingcustomradion4"
                                        name="rating" value="3" @checked($selectedRating=='3' )>
                                    <label class="custom-control-label font-size-base" for="ratingcustomradion4">
                                        <span class="d-flex align-items-end">
                                            <span class="star-rating">
                                                <span class="rating" style="width:60%;"></span>
                                            </span>

                                            <span class="ms-3">
                                                <span>3.0 & {{ __('rating_up') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="ratingcustomradion5"
                                        name="rating" value="2.5" @checked($selectedRating=='2.5' )>
                                    <label class="custom-control-label font-size-base" for="ratingcustomradion5">
                                        <span class="d-flex align-items-end">
                                            <span class="star-rating">
                                                <span class="rating" style="width:50%;"></span>
                                            </span>

                                            <span class="ms-3">
                                                <span>2.5 & {{ __('rating_up') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- <a href="#" type="" class="btn btn-primary btn-block mb-10">FILTER RESULTS</a> --}}
                    <button type="submit" class="btn btn-primary btn-block mb-10">{{ __('button_filter') }}</button>
                </div>
            </form>
        </div>


        <div class="col-xl-8">
            <div class="row row-cols-md-2 mb-3 ">
                @forelse ($courses as $course)
                <div class="col-md pb-4 pb-md-7">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            @auth
                            <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                <form action="{{ route('toggle-favorite', ['courseId' => $course->id]) }}" data-url="{{ route('toggle-favorite', ['courseId' => $course->id]) }}"
                                    method="post">
                                    @csrf
                                    @php
                                        $favorited = $course->favorites->where('user_id', auth()->id())->where('course_id',$course->id)->isNotEmpty();
                                    @endphp
                                    <button type="button"
                                        class="favorite-button btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36"
                                         style = "background-color: {{ $favorited ? 'red': '' }}"
                                        data-course-id="{{ $course->id }}"
                                        data-favorited="{{ $favorited ? 'true' : 'false' }}">
                                        <!-- Icon -->
                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                fill="currentColor" />
                                        </svg>

                                    </button>
                                </form>
                            </div>
                            @endauth
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="{{ $course->poster_url }}" alt="...">
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <a href="{{ route('teacher.show', ['id' => $course->user->id]) }}" class="">
                                <div
                                    class="avatar avatar-xl sk-fade-right badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                    <img src="{{ $course->user->profile->avatar }}" alt="..."
                                        class="avatar-img rounded-circle">
                                </div>
                            </a>

                            <!-- Preheading -->
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}"><span
                                    class="mb-1 d-inline-block text-gray-800">{{ $course->category->name }}</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                    class="d-block stretched-link">
                                    <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                        {{ $course->title }}</h4>
                                </a>

                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                        <div class="rating"
                                            style="width:{{ (($course->average_rating - 1) / 3.6) * 100 }}%;">
                                        </div>
                                    </div>

                                    <div class="font-size-sm">
                                        <span>{{ $course->average_rating }}
                                            ({{ convert_to_short_form($course->num_reviews) }}
                                            {{ __('reviews') }})
                                        </span>
                                    </div>
                                </div>

                                <div class="row mx-n2 align-items-end">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">{{ $course->total_lessons }}
                                                        {{ __('lessons') }}</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">{{ $course->total_time }}h</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <del class="font-size-sm">${{ $course->price }}</del>
                                        <ins class="h4 mb-0 d-block mb-lg-n1">${{
                                            number_format($course->discounted_price, 2) }}</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h2 class="text-center">No Courses Found</h2>
                @endforelse
            </div>
            {{-- END COURSE --}}
            <!-- PAGINATION ================================================== -->
            <nav class="mb-11" aria-label="Page navigationa">
                <ul class="pagination justify-content-center">
                    {!! $courses->links('pagination::bootstrap-4') !!}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
