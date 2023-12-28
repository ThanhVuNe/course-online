@extends('layouts.app')

@section('title', 'List Instructor')
@section('script')
    <script type="module">
        $(document).ready(function () {
        // Cache the instructor cards for performance
        var $instructorCards = $('.col-md');

        // Event handler for the search input
        $('#searchInstructor').on('input', function () {
            var query = $(this).val().toLowerCase();

            // Filter the instructor cards based on the search query
            $instructorCards.each(function () {
                var instructorName = $(this).find('.instructor-name').text().toLowerCase();

                // Show or hide the card based on the search query
                if (instructorName.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    </script>
@endsection
@section('content')
       <!-- PAGE TITLE
    ================================================== -->
    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Instructors</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Instructors
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>


    <!-- CONTROL BAR
    ================================================== -->
    <div class="container mb-6 mb-xl-8 z-index-2">
        <div class="d-xl-flex align-items-center">
            <div class="mx-xl-auto d-xl-flex flex-wrap">
                <div class="mb-4 mb-xl-0 ms-xl-6">
                    <!-- Search -->
                    <form class="">
                        <div class="input-group input-group-filter">
                            <input id="searchInstructor" class="form-control form-control-sm placeholder-dark shadow-none border-end-0" type="search" placeholder="Search instructor" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-white border-start-0 text-dark bg-transparent" type="submit">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z" fill="currentColor"/>
                                        <path d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z" fill="currentColor"/>
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mb-4 mb-xl-0 ms-xl-6">
                    <select class="form-select form-select-sm text-dark dropdown-menu-end" data-choices>
                        <option>All Categories</option>
                        <option>Another option</option>
                        <option>Something else here</option>
                    </select>
                </div>

                <div class="mb-4 mb-xl-0 ms-xl-6">
                    <div class="border rounded d-flex align-items-center choices-label h-50p">
                        <span class="ps-5">Sort by:</span>
                        <select class="form-select form-select-sm text-dark border-0 ps-1 bg-transparent flex-grow-1 dropdown-menu-end" data-choices>
                            <option>Default</option>
                            <option>New Courses</option>
                            <option>Price Low to High</option>
                            <option>Price High to low</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- COURSE
    ================================================== -->
    <div class="container pb-4 pb-xl-7">
        <div class="row row-cols-md-3 row-cols-lg-4 mb-6 mb-xl-3">
            @foreach ($instructors as $instructor)
                
            <div class="col-md pb-4 pb-md-7">
                <div class="card border shadow p-2 lift">
                    <!-- Image -->
                    <div class="card-zoom position-relative" >
                        <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                            <ul class="nav mx-n4 justify-content-center">
                                <li class="nav-item px-4">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="{{ route('teacher.show', ['id' => $instructor->id]) }}" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="{{ $instructor->profile->avatar }}" alt="..."></a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-3 pt-4 pb-1">
                        <a href="instructors-single.html" class="d-block"><h5 class="mb-0 instructor-name">{{ $instructor->profile->full_name }}({{ $instructor->username }})</h5></a>
                        <span class="font-size-d-sm">Developer</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection