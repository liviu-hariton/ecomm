<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @meta

    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
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
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
@include('frontend.layouts.header')

@include('frontend.layouts.main-menu')

@yield('main-content')

@include('frontend.layouts.footer')

<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

<script>
    $(document).ready(function() {
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();

            let _form_data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('add-to-cart') }}',
                data: _form_data,
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);

                        $("#cart-subtotal").html(data.cart_subtotal);
                        $("#cart-sidebar-subtotal").html(data.cart_subtotal);
                        $("#cart-total").html(data.cart_total);
                        $("#cart-count").html(data.cart_count);
                        $("#sidebar-cart-products").html(data.cart_sidebar_products);
                        $("#cart-discount").html(data.cart_discount);
                    } else {
                        Swal.fire(
                            'Hmmmm...',
                            data.message,
                            'warning'
                        );
                    }
                },
                error: function(xhr, status, error) {

                }
            });
        });

        $('.remove-from-cart').on('click', function(e) {
            e.preventDefault();

            let _url = $(this).attr('href');
            let _cart_id = $(this).data('cart-id');

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
                            "_token": "{{ csrf_token() }}",
                            "cart_id": _cart_id
                        },
                        success: function(data) {
                            if(data.status === 'success') {
                                toastr.success(data.message);

                                $("#cart-row-" + _cart_id).remove();
                                $("#top-cart-row-" + _cart_id).remove();

                                $("#cart-subtotal").html(data.cart_subtotal);
                                $("#cart-sidebar-subtotal").html(data.cart_subtotal);
                                $("#cart-total").html(data.cart_total);
                                $("#cart-count").html(data.cart_count);

                                getSidebarCartProducts();
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
    });
</script>

@stack('scripts')
</html>
