<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Ecomm</title>

    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-social/bootstrap-social.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css')}}">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('backend/assets/img/stisla-fill.svg')}}" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>Admin Login</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                @csrf

                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="{{ old('email') }}">

                                    @error('email')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">{{ __('Password') }}</label>
                                        <div class="float-right">
                                            <a href="{{ route('password.request') }}" class="text-small">{{ __('Forgot your password?') }}</a>
                                        </div>
                                    </div>

                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>

                                    @error('password')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">{{ __('Remember me') }}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="simple-footer">
                        Design By <a href="https://github.com/stisla/stisla" target="_blank">Muhamad Nauval Azhar</a>.<br />
                        Built with <a href="https://www.laravel.com" target="_blank">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('backend/assets/modules/jquery.min.js')}}"></script>
<script src="{{ asset('backend/assets/modules/popper.js')}}"></script>
<script src="{{ asset('backend/assets/modules/tooltip.js')}}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('backend/assets/modules/moment.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/stisla.js')}}"></script>
<script src="{{ asset('backend/assets/js/scripts.js')}}"></script>
<script src="{{ asset('backend/assets/js/custom.js')}}"></script>
</body>
</html>
