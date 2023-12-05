@extends('instructor.layouts.app')
@section('title', 'Create New Course')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/instructor/course.css') }}">
@endsection
@section('script')
    <script type="module" src="{{ asset('assets/js/instructor/create.course.js') }}"></script>
@endsection
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('instructor.home') }}">Home</a></li>
                <li class="breadcrumb-item">Management</li>
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="">

            <div class="card">
                <div class="card-body">
                    <!-- General Form Elements -->
                    <form action="{{ route('instructor.courses.store') }}" id="stepOne" method="POST">
                        @csrf
                        <div>
                            <h5 class="card-title">Step 1: Add Information Course</h5>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label fw-bold">Title <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="textIntroduction" class="col-sm-2 col-form-label fw-bold">Introduction <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <textarea cols="4" id="introduction" name="introduction" class="form-control">{{ old('introduction') }}</textarea>
                                    @error('introduction')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="selectCategory" class="col-sm-2 col-form-label fw-bold">Category <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="category_id" aria-label="Default select example">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="textIntroduction" class="col-sm-2 col-form-label fw-bold">Description <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <textarea cols="4" id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="textIntroduction" class="col-sm-2 col-form-label fw-bold">Learns Description <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <textarea cols="4" id="learns" name="learns_description" class="form-control">{{ old('learns_description') }}</textarea>
                                    @error('learns_description')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="textIntroduction" class="col-sm-2 col-form-label fw-bold">Requirements <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-10">
                                    <textarea cols="4" id="requirements" name="requirements_description" class="form-control">{{ old('requirements_description') }}</textarea>
                                    @error('requirements_description')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0 fw-bold">Language <span class="text-alizarin fst-italic">*</span></legend>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-2 form-check">
                                        <input class="form-check-input" type="radio" name="languages" id="english_lang"
                                            value="1">
                                        <label class="form-check-label" for="english_lang">
                                            {{ __('english_lang') }}
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-check">
                                        <input class="form-check-input" type="radio" name="languages" id="vietnamese_lang"
                                            value="2">
                                        <label class="form-check-label" for="vietnamese_lang">
                                            {{ __('vietnamese_lang') }}
                                        </label>
                                    </div>
                                    @error('languages')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </fieldset>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0 fw-bold">Level <span class="text-alizarin fst-italic">*</span></legend>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-2 form-check">
                                        <input class="form-check-input" type="radio" name="level" id="english_lang"
                                            value="1">
                                        <label class="form-check-label" for="english_lang">
                                            {{ __('beginner_level') }}
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-check">
                                        <input class="form-check-input" type="radio" name="level" id="vietnamese_lang"
                                            value="2">
                                        <label class="form-check-label" for="vietnamese_lang">
                                            {{ __('intermediate_level') }}
                                        </label>
                                    </div>
                                    <div class="col-sm-2 form-check">
                                        <input class="form-check-input" type="radio" name="level" id="vietnamese_lang"
                                            value="3">
                                        <label class="form-check-label" for="vietnamese_lang">
                                            {{ __('advanced_level') }}
                                        </label>
                                    </div>
                                    @error('level')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label fw-bold">Price (USD) <span class="text-alizarin fst-italic">*</span></label>
                                <div class="col-sm-4">
                                    <div class="inputWithIcon">
                                        <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}">
                                        <i class="bi bi-currency-dollar me-2"></i>
                                        @error('price')
                                            <div class="text-alizarin fst-italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <label for="inputNumber" class="col-sm-2 col-form-label fw-bold">Discount (%)</label>
                                <div class="col-sm-4">
                                    <div class="inputWithIcon">
                                        <input type="number" min="0" max="100" step="1" name="discount" class="form-control" value="{{ old('discount') }}">
                                        <i class="bi bi-percent me-2"></i>
                                    </div>
                                    @error('discount')
                                        <div class="text-alizarin fst-italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="offset-sm-9 col-sm-1">
                                    <button type="submit" id="nextStep1" class="btn btn-primary">NEXT</button>
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
