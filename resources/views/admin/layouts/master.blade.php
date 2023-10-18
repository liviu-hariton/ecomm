<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard &mdash; Ecomm</title>

    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('admin.layouts.navbar')

        @include('admin.layouts.sidebar')

        <div class="main-content">
            @yield('main-section')
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                <div class="bullet"></div> Design By <a href="https://github.com/stisla/stisla" target="_blank">Muhamad Nauval Azhar</a>.
                Built with <a href="https://www.laravel.com" target="_blank">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
<script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/stisla.js') }}"></script>
<script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/page/index-0.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>
</body>
</html>
