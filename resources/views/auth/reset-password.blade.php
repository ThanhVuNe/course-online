@extends('layouts.app')
@section('title', 'Reset Password')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('content')
    <section class="">
        <div class="flickity-button-outset-long flickity-page-dots-white flickity-page-dots-43">
            <!-- Success Notification -->
            @include('layouts.message')
            <div class="w-100">
                <div class="py-10 overlay overlay-custom-left" style="background-image: url(/assets/img/covers/cover-16.jpg)">
                    <div class="container">
                        <div class="row align-items-center py-md-5 gx-0">
                            <div class="container py-9">
                                <div class="row gx-0">
                                    <div class="col-md-8 col-xl-4 py-5 px-5 mx-auto bg-white accordion-body rounded-3">
                                        <!-- Login -->
                                        <h3 class="mb-6 text-center">{{ __('reset_title') }}</h3>
                                        <!-- Form Login -->
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <!-- Email -->
                                            <div class="form-group mb-5">
                                                <input id = "email" type="email" name="email" class="form-control" value="{{ $email }}" readonly>
                                                @error('email')
                                                    <span class="text-alizarin fst-italic">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-5">
                                                <label for="password">
                                                    {{ __('password') }}
                                                </label>
                                                <input id = "password" type="password" name="password" class="form-control"
                                                    value="{{ old('password') }}" required>
                                                @error('password')
                                                    <span class="text-alizarin fst-italic">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-5">
                                                <label for="password_confirmation">Confirm
                                                    Password</label>
                                                <input id = "password_confirmation" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                                @error('password_confirmation')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Submit -->
                                            <button class="btn btn-block btn-primary" type="submit">
                                                {{ strtoupper(__('reset_title')) }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
