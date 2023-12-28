@extends('instructor.layouts.app')
@section('title', 'Create New Topic')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/instructor/course.css') }}">
@endsection.
@section('script')
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    <script src="{{ asset('assets/js/instructor/create.lesson.js') }}"></script>
    <script src="{{ asset('assets/js/instructor/change.image.lesson.js') }}"></script>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add New Lesson</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('instructor.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Lessons</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <!-- Modal -->
        <div class="modal fade" id="modalNotification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="staticBackdropLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">Please wait for the files to upload</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModal"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="">

                <div class="card">
                    <div class="mt-4 card-body rounded">
                        <!-- General Form Elements -->
                        <form method="POST" data-url="{{ route('instructor.lessons.store') }}" id="formCreate">
                            @csrf
                            <div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label fw-bold">Title <span
                                            class="text-alizarin fst-italic">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="title" type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label fw-bold">Time duration <span
                                            class="text-alizarin fst-italic">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="timeDurationFormat" class="form-control" readonly>
                                        <input id="timeDuration" type="hidden" name="lesson_duration" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="topic_id" value="{{ $topicId }}" id="topicId">
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label fw-bold">Trailer Upload <span
                                            class="text-alizarin fst-italic">*</span></label>
                                    <div class="col-sm-10 row change-img">
                                        <div class="col-sm-6 video-change">
                                            <img class="mb-3 change-video"
                                                src="{{ asset('assets/img/icons/show-change-image.jpg') }}" alt="">
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="lessonUrl" type="file" name="lesson_url" class="form-control"
                                                onchange="readURL(this);" accept="video/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="offset-sm-10 col-sm-2">
                                        <button type="button" id="uploadS3" class="btn btn-success">UPLOAD</button>
                                        <a href="{{ route('instructor.courses.curriculum.show', ['courseId' => $courseId]) }}" id="btnFinish" class="btn btn-primary">FINISH</a>
                                    </div>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
