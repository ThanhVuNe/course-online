@extends('instructor.layouts.app')
@section('title', 'Create New Question')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/instructor/course.css') }}">
@endsection.
@section('script')
    <script src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add New Question</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('instructor.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Topic</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Question</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

      
        <section class="section">
            <div class="">

                <div class="card">
                    <div class="mt-4 card-body rounded">
                        <!-- General Form Elements -->
                        <form method="POST" data-url="{{ route('instructor.question.create', ['topicId' => $topicId]) }}" id="formCreate">
                            @csrf
                            <div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label fw-bold">Title <span
                                            class="text-alizarin fst-italic">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="title" type="text" name="title" class="form-control">
                                    </div>
                                </div>
                               
                                <div id="answers-container">
                                    <!-- Answers will be dynamically added here -->
                                </div>
                                <div class="row mb-3 mt-3">
                                    <div class="offset-sm-9 d-flex">
                                        <button type="button" id="addAnswer" class="btn btn-primary mx-2">Add Answer</button>
                                        <button type="submit" id="uploadS3" class="btn btn-success mx-2">Create</button>
                                        {{-- <a href="{{ route('instructor.courses.curriculum.show', ['courseId' => $courseId]) }}" id="btnFinish" class="btn btn-primary">FINISH</a> --}}
                                    </div>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addAnswerButton = document.getElementById('addAnswer');
            const answersContainer = document.getElementById('answers-container');
            let answerIndex = 1;
    
            addAnswerButton.addEventListener('click', function () {
                const answerInput = document.createElement('input');
                answerInput.setAttribute('type', 'text');
                answerInput.setAttribute('name', 'answers[' + answerIndex + ']');
                answerInput.setAttribute('class', 'form-control');
                answerInput.setAttribute('placeholder', 'Answer ' + answerIndex);
    
                const correctAnswerRadio = document.createElement('input');
                correctAnswerRadio.setAttribute('type', 'radio');
                correctAnswerRadio.setAttribute('name', 'correct_answer');
                correctAnswerRadio.setAttribute('value', answerIndex);
                correctAnswerRadio.classList.add('ms-2');
    
                const deleteButton = document.createElement('button');
                deleteButton.innerHTML = '<i class="bi bi-x"></i>'; // Bootstrap remove icon
                deleteButton.setAttribute('type', 'button');
                deleteButton.setAttribute('class', 'btn btn-danger mx-2');

                if (answerIndex === 1) {
                    correctAnswerRadio.setAttribute('required', 'required');
                }

    
                const answerDiv = document.createElement('div');
                answerDiv.classList.add('d-flex', 'align-items-center', 'mb-3');
                answerDiv.appendChild(answerInput);
                answerDiv.appendChild(correctAnswerRadio);
                answerDiv.appendChild(deleteButton);
                answersContainer.appendChild(answerDiv);
    
                deleteButton.addEventListener('click', function () {
                    answerDiv.remove();
                    reindexAnswers();
                });
    
                answerIndex++;
            });

            function reindexAnswers() {
            const answerDivs = answersContainer.querySelectorAll('div');
            answerIndex = 1;
            answerDivs.forEach(function (div) {
                const answerInput = div.querySelector('input[type="text"]');
                const correctAnswerRadio = div.querySelector('input[type="radio"]');
                answerInput.setAttribute('name', 'answers[' + answerIndex + ']');
                correctAnswerRadio.setAttribute('value', answerIndex);
                answerIndex++;
            });
        }
        });
    </script>
    
    
@endsection
