@extends('layouts.app')
@section('title', 'Forgot Password')
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
                                        <h3 class="mb-6 text-center">{{ __('forgot_title') }}</h3>
                                        <!-- Form Login -->
                                        <form class="mb-5" action="{{ route('password.email') }}" method="POST">
                                            @csrf
                                            <!-- Email -->
                                            <div class="form-group mb-5">
                                                <label for="modalSigninEmail1">
                                                    {{ __('email') }}
                                                </label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="johndoe@creativelayers.com" value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="text-alizarin fst-italic">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Submit -->
                                            <button class="btn btn-block btn-primary" type="submit">
                                                {{ strtoupper(__('send_link_reset')) }}
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
