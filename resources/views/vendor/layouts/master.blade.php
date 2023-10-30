<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">
    <title>User dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
<div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
        <img src="{{ asset(auth()->user()->image ?? 'backend/assets/img/avatar/avatar-1.png') }}"
             alt="{{ auth()->user()->name }}" class="img-fluid">
        <p>{{ auth()->user()->name }}</p>
    </div>
</div>

<section id="wsus__dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-2">
                @include('vendor.layouts.sidebar')
            </div>
            <div class="col-12 col-md-10">
                <div class="dashboard_content">
                    @yield('dashboard-main-content')
                </div>
            </div>
        </div>
    </div>
</section>

<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>

<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
<script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
<script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
<script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
<script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
<script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
<script src="{{ asset('vendor/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/js/scripts.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
                url: '{{ route('vendor.change-status') }}',
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
                url: '{{ route('vendor.change-featured') }}',
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

        $('body').on('click', '.change-default', function(e) {
            $('.defaults').prop('checked', false);
            $(this).prop('checked', true);

            let _is_default = $(this).is(':checked') === true ? '1' : '0';
            let _vid = $(this).data('vid');
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('vendor.change-default') }}',
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
