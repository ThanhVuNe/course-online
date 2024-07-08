@extends('instructor.layouts.app')
@section('title', 'Create New Course')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/instructor/course.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
@endsection.
@section('script')
    <script type="module" src="{{ asset('assets/js/instructor/create.course.js') }}"></script>
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Question</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('instructor.home') }}">Course</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item"><a href="{{ route('instructor.courses.curriculum.show', ['courseId' => $courseId]) }}">Topic</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class = "container">
                <h2 class="text-center font-weight-bold">Questions of topic {{ $topic->name }}</h2>
                <div class = "row mb-8">
                    <div class = "offset-lg-1 col-lg-10 mb-6 mb-lg-0 position-relative">
                        <!-- Img -->
                        @include('layouts.message')
                        <div id="Curriculum" class="mb-9">
                            <div id="accordionCurriculum">
                                @foreach ($topic->questions as $key => $question)
                                    <div class="border rounded shadow mb-6 overflow-hidden">

                                        <div class="d-flex align-items-center" id="curriculumheading{{ $key }}">
                                            <div class="col-lg-9">
                                                <h5 class="mb-0 w-100">
                                                    <button
                                                        class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#Curriculumcollapse{{ $key }}"
                                                        aria-expanded="true"
                                                        aria-controls="Curriculumcollapse{{ $key }}">
                                                        <span class="me-4 text-dark d-flex">
                                                            <!-- Icon -->
                                                            <svg width="15" height="2" viewBox="0 0 15 2"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="15" height="2" fill="currentColor">
                                                                </rect>
                                                            </svg>

                                                            <svg width="15" height="16" viewBox="0 0 15 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                                                <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </span> {{ $question->title }} </button>
                                                </h5>
                                            </div>
                            
                                            {{-- <div class="col-lg-2 mx-2">
                                                <a class="btn btn-primary btn-sm btn-block mx-3"
                                                    style="background-color:#8685d1" type="button" name="button"
                                                    href="{{ route('instructor.topic.answers.create', ['questionId' => $question->id]) }}">Add
                                                    Answer</a>
                                            </div> --}}
                                        </div>

                                        <div id="Curriculumcollapse{{ $key }}" class="collapse show"
                                            aria-labelledby="curriculumheading{{ $key }}"
                                            data-parent="#accordionCurriculum">
                                            @foreach ($question->answers as $key => $answer)
                                                <div
                                                    class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                                    <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                                        <div class="text-secondary d-flex">
                                                            <svg width="14" height="18" viewBox="0 0 14 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </div>

                                                        <div class="ms-4">
                                                            {{ $answer->title }}
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                                        @if ($answer->is_correct == 1)
                                                            <div
                                                            class="badge text-dark-70 me-5 font-size-sm fw-normal py-2" style="background-color: greenyellow">
                                                            <i class="bi bi-check" style="font-size: 20px"></i>
                                                            </div>
                                                        @else
                                                            <div
                                                            class="badge text-dark-70 me-5 font-size-sm fw-normal py-2" style="background-color: red">
                                                            <i class="bi bi-x" style="font-size: 20px"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a class="btn btn-primary shadow"
                            style="position: fixed; bottom: 100px; right: 100px; z-index: 1000;"
                            href="{{ route('instructor.question.create', ['topicId' => $topic->id]) }}" style="">Add
                            question</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
