@extends('layouts.app')

@section('title', 'Register Instructor')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('content')
    <div class="container py-4 bg-white-ice">
        <div class="row">
            @include('user.sidebar')
            @include('layouts.message')
            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <form method="POST" action="{{ route('users.sendMail') }}">
                            @csrf
                            @instructor
                                <h2 style="text-align: center;">YOU HAVE REGISTERED AS AN INSTRUCTOR</h2>
                                <div class="text-center my-5">
                                    <a class="btn btn-primary" href="{{ route('instructor.home') }}">
                                        Click to go to the page instructor
                                    </a>
                                </div>
                            @else
                                <h2 style="text-align: center;">FORM REGISTER INSTRUCTOR</h2>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                        name="email" value="{{ $user->email }}" disabled>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            @endinstructor
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
