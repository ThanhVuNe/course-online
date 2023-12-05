@extends('layouts.app')
@section('title', 'Survey User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/survey.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/js/survey.js') }}"></script>
@endsection
@section('modal')
    <!-- Modal -->
    <div class="col-md-10 modal fade survey-modal mt-5" id="surveyForm" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="surveyFormContent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="col-md-10 modal-content mt-12">
                <div class="modal-body">
                    <div class="slide-begin">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mt-3 mb-5">Welcome to our survey user!</h3>
                                <p>We are thrilled that you have registered an account with us.</p>
                                <p>As a registered user, you have access to a world of knowledge and growth opportunities.
                                    We're here to help you make the most of your learning journey by recommending courses
                                    tailored to your interests and goals.</p>
                                <p>By completing the our survey, you're taking a significant step towards achieving your
                                    learning objectives.</p>
                            </div>
                            <div class="col-md-6">
                                <img width="100%" src="{{ asset('assets/img/illustrations/survey-1.png') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="group-btn-function">
                            <button type="button" class="btn btn-primary btn-next-slide">Next</button>
                        </div>
                    </div>
                    <div class="slide-survey" style="display: none">
                        <form id="formSurvey" method="post" action="{{ route('surveys.store') }}">
                            @csrf
                            <div class="row">
                                <div class="header-container">
                                    <div class="progress bg-primary-desat mb-5"></div>
                                    <h3 class="title mt-3 mb-5">What kind of study do you want to learn?</h3>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6 content">
                                        <div class="page-1">
                                            @foreach ($categories as $category)
                                                <div class="col-sm-12 form-check">
                                                    <input class="form-check-input" name="name[]" type="checkbox"
                                                        id="gridCheck1" value="{{ $category->id }}">
                                                    <label class="form-check-label" for="english_lang">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="page-2" style="display: none">
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="radio" name="languages"
                                                    id="english_lang" value="1">
                                                <label class="form-check-label" for="english_lang">
                                                    {{ __('english_lang') }}
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="radio" name="languages"
                                                    id="vietnamese_lang" value="2">
                                                <label class="form-check-label" for="vietnamese_lang">
                                                    {{ __('vietnamese_lang') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="page-3" style="display: none">
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="radio" name="level"
                                                    id="english_lang" value="1">
                                                <label class="form-check-label" for="english_lang">
                                                    {{ __('beginner_level') }}
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="radio" name="level"
                                                    id="vietnamese_lang" value="2">
                                                <label class="form-check-label" for="vietnamese_lang">
                                                    {{ __('intermediate_level') }}
                                                </label>
                                            </div>
                                            <div class="col-sm-2 form-check">
                                                <input class="form-check-input" type="radio" name="level"
                                                    id="vietnamese_lang" value="3">
                                                <label class="form-check-label" for="vietnamese_lang">
                                                    {{ __('advanced_level') }}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <img width="100%" src="{{ asset('assets/img/illustrations/survey-2.png') }}"
                                            alt="">
                                    </div>

                                </div>
                                <div>
                                    <div class="group-btn-function">
                                        <div class="group-btn-survey">
                                            <a class="btn btn-secondary me-3" id="prev" style="display: none">Back</a>
                                        </div>
                                        <div class="group-btn-survey">
                                            <a class="btn btn-primary" id="next" type="submit">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section class="">
        <div class="flickity-button-outset-long flickity-page-dots-white flickity-page-dots-43">
            <div class="w-100">
                <div class="py-10 overlay overlay-custom-left"
                    style="background-image: url(/assets/img/covers/cover-16.jpg); height: 1044px">
                </div>
            </div>
        </div>
    </section>
@endsection
