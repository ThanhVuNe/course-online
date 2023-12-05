@extends('layouts.app')
@section('title', 'Login account')
@section('content')
    <section class="">
        <div class="flickity-button-outset-long flickity-page-dots-white flickity-page-dots-43">
            <div class="w-100">
                <div class="py-10 overlay overlay-custom-left" style="background-image: url({{ asset('assets/img/covers/cover-16.jpg') }})">
                    <div class="container">
                        <div class="row align-items-center py-md-5 gx-0">
                            <div class="container py-9">
                                <div class="row gx-0">
                                    <div class="col-md-8 col-xl-4 py-5 px-5 mx-auto bg-white accordion-body rounded-3">
                                        @if (session()->has('message'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <div>
                                                    <span class="alert-icon"><i class="fa-solid fa-thumbs-up"></i></span>
                                                    <span class="alert-text"><strong class="me-2">{{ __('success') }}</strong><br></span>
                                                </div>
                                                <div><span class="messageNotice">{{ session()->get('message') }}</span></div>
                                                <button type="button" class="btn-close" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session()->has('error'))
                                            <div class="alert alert-alizarin alert-dismissible fade show" role="alert">
                                                <div>
                                                    <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></i></span>
                                                    <span class="alert-text"><strong class="me-2">{{ __('error') }}</strong><br></span>
                                                </div>
                                                <div><span class="messageNotice">{{ session()->get('error') }}</span></div>
                                                <button type="button" class="btn-close" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <!-- Login -->
                                        <h3 class="mb-6 text-center">{{ __('login_title') }}</h3>

                                        <!-- Form Login -->
                                        <form class="mb-5" action="{{ route('login.auth') }}" method="POST">
                                            @csrf
                                            <!-- Email -->
                                            <div class="form-group mb-5">
                                                <label for="modalSigninEmail1">
                                                    {{ __('email') }}
                                                </label>
                                                <input type="email" name="email" class="form-control"
                                                    id="modalSigninEmail1" placeholder="johndoe@creativelayers.com"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="text-alizarin fst-italic">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group mb-5">
                                                <label for="modalSigninPassword1">
                                                    {{ __('password') }}
                                                </label>
                                                <input type="password" name="password" class="form-control"
                                                    id="modalSigninPassword1" placeholder="**********"
                                                    value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="text-alizarin fst-italic">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="d-flex align-items-center mb-5 font-size-sm">
                                                <div class="form-check">
                                                    <input class="form-check-input text-gray-800" type="checkbox"
                                                        id="autoSizingCheck1">
                                                    <label class="form-check-label text-gray-800" for="autoSizingCheck1">
                                                        {{ __('remember') }}
                                                    </label>
                                                </div>

                                                <div class="ms-auto">
                                                    <a class="text-gray-800"
                                                        href="{{ route('password.request') }}">{{ __('forgot') }}</a>
                                                </div>
                                            </div>

                                            <!-- Submit -->
                                            <button class="btn btn-block btn-primary" type="submit">
                                                {{ strtoupper(__('login')) }}
                                            </button>
                                        </form>

                                        <!-- Text -->
                                        <p class="mb-0 font-size-sm text-center">
                                            {{ __('login_label') }} <a class="text-underline fw-semi-bold"
                                                href="{{ route('register.show') }}">{{ __('register') }}</a>
                                        </p>
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
