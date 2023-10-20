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
                            <li><a href="#">password reset</a></li>
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
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>forgot password ?</h4>
                        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('Email') }}">
                                </div>

                                @error('email')
                                <span class="text-danger text-small">{{ $message }}</span>
                                @enderror

                                <button class="common_btn" type="submit">{{ __('Email Password Reset Link') }}</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
