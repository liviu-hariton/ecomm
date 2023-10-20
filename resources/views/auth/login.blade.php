@extends('frontend.layouts.master')

@section('main-content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>login / sign up</h4>
                        <ul>
                            <li><a href="/">home</a></li>
                            <li><a href="#">login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                        aria-selected="true">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('register') }}" class="nav-link">signup</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                 aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" id="email" required autofocus autocomplete="username" placeholder="{{ __('Email') }}">
                                        </div>

                                        @error('email')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" name="password" id="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                        </div>

                                        @error('password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                            </div>

                                            <a class="forget_p" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                        </div>
                                        <button class="common_btn" type="submit">{{ __('Log in') }}</button>

                                        {{--<p class="social_text">Sign in with social account</p>
                                        <ul class="wsus__login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
