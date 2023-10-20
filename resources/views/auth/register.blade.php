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
                            <li><a href="#">sign up</a></li>
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
                                <a href="{{ route('login') }}" class="nav-link">login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-profile-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-profiles" type="button" role="tab"
                                        aria-controls="pills-profiles" aria-selected="true">signup</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-profiles" role="tabpanel"
                                 aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" name="name" id="name" required autofocus autocomplete="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}">
                                        </div>

                                        @error('name')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" id="email" name="email" required autocomplete="username" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                                        </div>

                                        @error('email')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                                        </div>

                                        @error('password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <div class="wsus__login_input mb-5">
                                            <i class="fas fa-key"></i>
                                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                        </div>

                                        @error('password_confirmation')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror

                                        <button class="common_btn" type="submit">{{ __('Register') }}</button>
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
