@extends('frontend.layouts.master')

@section('main-content')
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                @if(count($items) > 0)
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_status">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="{{ route('clear-cart') }}" class="common_btn clear-cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach($items as $item)
                                        <tr class="d-flex" id="cart-row-{{ $item->rowId }}">
                                            <td class="wsus__pro_img">
                                                <a href="{{ route('product', $item->options->slug) }}"><img src="{{ asset($item->options->image) }}" alt="{{ $item->name }}" class="img-fluid w-100"></a>
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p><a href="{{ route('product', $item->options->slug) }}">{{ $item->name }}</a></p>
                                                @foreach($item->options->variants as $variant_name=>$variant_value)
                                                    <span>{{ $variant_name }}: {{ $variant_value['name'] }} (+ {{ $variant_value['price'] }} <i class="{{ $general_settings->currency_icon }}"></i>)</span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>{{ $item->price }} <i class="{{ $general_settings->currency_icon }}"></i></p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-danger product-decrement" type="button"><i class="fa fa-minus"></i></button>
                                                    <input class="form-control text-center product-qty" data-cart-id="{{ $item->rowId }}" type="text" min="1" max="100" value="{{ $item->qty }}" />
                                                    <button class="btn btn-outline-success product-increment" type="button"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6><span id="cart-item-total-{{ $item->rowId }}">{{ ($item->price + $item->options->variants_amount) * $item->qty }}</span> <i class="{{ $general_settings->currency_icon }}"></i></h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('remove-from-cart') }}" class="remove-from-cart" data-cart-id="{{ $item->rowId }}"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal: <span id="cart-subtotal">{{ cartSubtotal() }}</span> <i class="{{ $general_settings->currency_icon }}"></i></p>
                            <p>delivery: <span>00.00</span> <i class="{{ $general_settings->currency_icon }}"></i></p>
                            <p>discount: <span>10.00</span> <i class="{{ $general_settings->currency_icon }}"></i></p>
                            <p class="total"><span>total:</span> <span id="cart-total">{{ cartTotal() }}</span> <i class="{{ $general_settings->currency_icon }}"></i></p>

                            <form>
                                <input type="text" placeholder="Coupon Code">
                                <button type="submit" class="common_btn">apply</button>
                            </form>
                            <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                            <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i class="fab fa-shopify"></i> go shop</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        Your cart is empty.
                    </div>
                @endif

            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/images/single_banner_2.jpg') }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/images/single_banner_3.jpg') }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.product-increment').on('click', function() {
                let _qty_input = $(this).siblings('.product-qty');
                let _qty = parseInt(_qty_input.val()) + 1;

                _qty_input.val(_qty);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-qty') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cart_id": _qty_input.data('cart-id'),
                        "qty": _qty
                    },
                    success: function(data) {
                        if(data.status === 'success') {
                            $("#cart-item-total-" + _qty_input.data('cart-id')).html(data.product_total);
                            $("#cart-subtotal").html(data.cart_subtotal);
                            $("#cart-sidebar-subtotal").html(data.cart_subtotal);
                            $("#cart-total").html(data.cart_total);
                            $("#cart-count").html(data.cart_count);
                            $("#sidebar-cart-products").html(data.cart_sidebar_products);
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

            $('.product-decrement').on('click', function() {
                let _qty_input = $(this).siblings('.product-qty');

                if(parseInt(_qty_input.val()) > 1) {
                    let _qty = parseInt(_qty_input.val()) - 1;

                    _qty_input.val(_qty);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('update-qty') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "cart_id": _qty_input.data('cart-id'),
                            "qty": _qty
                        },
                        success: function(data) {
                            $("#cart-item-total-" + _qty_input.data('cart-id')).html(data.product_total);
                            $("#cart-subtotal").html(data.cart_subtotal);
                            $("#cart-sidebar-subtotal").html(data.cart_subtotal);
                            $("#cart-total").html(data.cart_total);
                            $("#cart-count").html(data.cart_count);
                            $("#sidebar-cart-products").html(data.cart_sidebar_products);
                        },
                        error: function(xhr, status, error) {

                        }
                    });
                }
            });

            $('.clear-cart').on('click', function(e) {
                e.preventDefault();

                let _url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FB160A',
                    cancelButtonColor: '#4CEA67',
                    confirmButtonText: 'Yes, clear it!'
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
                                    window.location.reload();
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
@endpush
