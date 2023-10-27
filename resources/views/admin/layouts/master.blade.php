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
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/js/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('admin.layouts.navbar')

        @include('admin.layouts.sidebar')

        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

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
<script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ asset('backend/assets/js/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('body').on('click', '.delete-item', function(e) {
            e.preventDefault();

            let _url = $(this).attr('href');

            let _table = $('#' + $(this).data('table')).DataTable();
            let _row = _table.row($(this).closest('tr'));

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FB160A',
                cancelButtonColor: '#4CEA67',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: _url,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if(data.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                );

                                _row.remove().draw();
                            } else {
                                Swal.fire(
                                    'Hmmmm...',
                                    data.message,
                                    'warning'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Ups!',
                                error,
                                'danger'
                            );
                        }
                    });
                }
            })
        });

        $('body').on('click', '.change-status', function(e) {
            let _status = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.change-status') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status" : _status,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        Swal.fire(
                            'Hmmmm...',
                            data.message,
                            'warning'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Ups!',
                        error,
                        'danger'
                    );
                }
            });
        });

        $('body').on('click', '.change-featured', function(e) {
            let _featured = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.change-featured') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "featured" : _featured,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        Swal.fire(
                            'Hmmmm...',
                            data.message,
                            'warning'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Ups!',
                        error,
                        'danger'
                    );
                }
            });
        });

        $('body').on('click', '.change-approved', function(e) {
            let _approved = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.change-approved') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "approved" : _approved,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        Swal.fire(
                            'Hmmmm...',
                            data.message,
                            'warning'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Ups!',
                        error,
                        'danger'
                    );
                }
            });
        });

        $('body').on('click', '.change-default', function(e) {
            $('.defaults').prop('checked', false);
            $(this).prop('checked', true);

            let _is_default = $(this).is(':checked') === true ? '1' : '0';
            let _vid = $(this).data('vid');
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.change-default') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "is_default" : _is_default,
                    "vid": _vid,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        Swal.fire(
                            'Hmmmm...',
                            data.message,
                            'warning'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Ups!',
                        error,
                        'danger'
                    );
                }
            });
        });
    });
</script>

@stack('scripts')
</body>
</html>
