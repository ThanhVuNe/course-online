@extends('layouts.app')
@section('title', 'My Courses')
@section('style')
    <style>
        .progress {
            height: 5px;
            background-color: #f5f5f5;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .progress-bar {
            background-color: blueviolet;
            border-radius: 10px;
        }
    </style>
@endsection
@section('script')
    <script type="module" src="{{ asset('assets/js/remove.duplicate.js') }}"></script>
@endsection
@section('content')
    <!-- PAGE TITLE
        ================================================== -->
    @include('user.course.header')

    <div class="container">
        <!-- CONTROL BAR
            ================================================== -->
        <div class="mb-6 mb-xl-8 z-index-2">
            <div class="d-xl-flex align-items-center">
                <div class="d-xl-flex flex-wrap">
                    <div>
                        <div class="ms-xl-auto d-xl-flex flex-wrap">
                            <div class="mb-4 mb-xl-0">{{ __('sort_by') }}:(To do)</div>
                        </div>
                        <div class="mb-4 mb-xl-0">
                            <div class="border rounded d-flex align-items-center choices-label h-50p">
                                <select
                                    class="form-select form-select-sm text-dark border-0 ps-1 bg-transparent flex-grow-1 shadow-none dropdown-menu-end"
                                    data-choices>
                                    <option>{{ __('sort.default') }}</option>
                                    <option>{{ __('sort.new_courses') }}</option>
                                    <option>{{ __('sort.most_reviewed') }}</option>
                                    <option>{{ __('sort.highest_rated') }}</option>
                                    <option>{{ __('sort.highest_student') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="ms-xl-auto d-xl-flex flex-wrap">
                            <div class="mb-4 mb-xl-0 ms-xl-6">{{ __('filter_by') }}:(To do)</div>
                        </div>
                        <div class="ms-xl-auto d-xl-flex flex-wrap">
                            <div class="mb-4 mb-xl-0 ms-xl-6">
                                <select id="optionCategories" class="form-select form-select-sm text-dark shadow-none dropdown-menu-end"
                                    data-choices>
                                    <option>{{ __('all_categories') }}</option>
                                    @foreach ($courses as $option)
                                        <option value="{{ $option->course->category->id }}">{{ ucfirst($option->course->category->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 mb-xl-0 ms-xl-6">
                                <select class="form-select form-select-sm text-dark shadow-none dropdown-menu-end"
                                    data-choices>
                                    <option>All Levels</option>
                                    <option>{{ __('beginner_level') }}</option>
                                    <option>{{ __('intermediate_level') }}</option>
                                    <option>{{ __('advanced_level') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ms-xl-auto">
                    <div class="float-wd-end">
                        <div class="mb-4 mb-xl-0 ms-xl-6">
                            {{ __('search') }}:(To do)
                        </div>
                        <div class="mb-4 mb-xl-0 ms-xl-6">
                            <!-- Search -->
                            <form class="">
                                <div class="input-group input-group-filter float-xl-end">
                                    <input class="form-control form-control-sm placeholder-dark border-end-0 shadow-none"
                                        type="search" placeholder="Search your courses" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-outline-white border-start-0 text-dark bg-transparent"
                                            type="submit">
                                            <!-- Icon -->
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SHOW COURSES
            ================================================== -->
        <div class="row row-cols-md-3 mb-3">
            @foreach ($courses as $course)
                <div class="col-md mb-6 pb-4 pb-md-7">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="{{ route('courses.show', ['course' => $course->course_id]) }}" class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="{{ $course->course->poster_url }}"
                                    alt="...">
                            </a>

                            <div class="progress m-0">
                                <div class="progress-bar" role="progressbar" style="width: {{ round_percent($course->course->progress) }}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="m-0" style="font-size: 12px;">{{{ round_percent($course->course->progress) }}}% complete</p>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">

                            <!-- Preheading -->
                            <ul class="nav mx-n3 mb-3 d-xl-flex align-items-center">
                                <li class="nav-item px-3 badge badge-lg badge-purple badge-pill ms-2 px-5">
                                    <a href="#"><span class="mb-1 d-inline-block text-white font-size-sm">{{ ucfirst($course->course->category->name) }}</span></a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <div class="position-relative">
                                {{-- <a href="#" class="d-block stretched-link"> --}}
                                    <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">{{ $course->title }}</h4>
                                {{-- </a> --}}

                                <div class="row mx-n2 align-items-end">
                                    <div class="col px-2 font-size-sm text-show-line">
                                        {!! $course->brief !!}
                                    </div>
                                </div>
                                <div class="row mx-n2 mt-3 align-items-end">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">{{ $course->course->total_lessons }} lessons</div>
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
                                                    <div class="font-size-sm">{{ $course->course->total_time }}h</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- PAGINATION ================================================== -->
        <nav class="mb-11" aria-label="Page navigationa">
            <ul class="pagination justify-content-center">
                {!! $courses->links('pagination::bootstrap-4') !!}
            </ul>
        </nav>
    </div>

@endsection
