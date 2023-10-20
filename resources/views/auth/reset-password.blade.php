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
                            <li><a href="#">new password</a></li>
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
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="wsus__login_input">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" id="email" required autofocus autocomplete="username" value="{{ old('email', $request->email) }}" placeholder="{{ __('Email') }}">
                                </div>

                                @error('email')
                                <span class="text-danger text-small">{{ $message }}</span>
                                @enderror

                                <div class="wsus__login_input">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="password" id="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                                </div>

                                @error('password')
                                <span class="text-danger text-small">{{ $message }}</span>
                                @enderror

                                <div class="wsus__login_input">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                </div>

                                @error('password_confirmation')
                                <span class="text-danger text-small">{{ $message }}</span>
                                @enderror

                                <button class="common_btn" type="submit">{{ __('Reset Password') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
