@extends('instructor.layouts.app')
@section('title', 'Create New Topic')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
@endsection.
@section('script')
    <script type="module" src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class = "container">
                <div class = "row">
                    <div class="col-md-6 offset-md-3">
                        @include('layouts.message')
                        <div class="card">
                            <div class="card-body" style="margin: 10px;padding: -10px;">
                                <h5 class="card-title">Add Topic</h5>
                                <!-- Vertical Form -->
                                <form class="row g-3" method="POST"
                                    action="{{ route('instructor.topics.store', ['courseId' => $courseId]) }}">
                                    @csrf
                                    <div class="col-12" style="margin-top: 20px;">
                                        <label for="name" class="form-label">Topic Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                        <input type="hidden" class="form-control" name="course_id"
                                            value="{{ $courseId }}">
                                    </div>
                                    <div class="text-center" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href = {{route('instructor.courses.curriculum.show', ['courseId' => $courseId])}}  class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection
