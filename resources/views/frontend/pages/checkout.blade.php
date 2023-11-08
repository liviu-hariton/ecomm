@extends('frontend.layouts.master')

@section('main-content')
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__checkout_form">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Shipping Details <a href="{{ route('user.addresses.create') }}">add new address</a></h5>

                            <div class="row">
                                @foreach($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input shipping-address" type="radio" name="address" id="address-{{ $address->id }}" value="{{ $address->id }}">
                                                <label class="form-check-label" for="address-{{ $address->id }}"> Select Address </label>
                                            </div>
                                            <ul>
                                                <li><span>Name :</span> {{ $address->name }}</li>
                                                <li><span>Phone :</span> {{ $address->phone }}</li>
                                                <li><span>Email :</span> {{ $address->email }}</li>
                                                <li><span>Country :</span> {{ $address->country }}</li>
                                                <li><span>City :</span> {{ $address->city }}, {{ $address->state }}</li>
                                                <li><span>Zip Code :</span> {{ $address->zipcode }}</li>
                                                <li><span>Address :</span> {{ $address->address }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <h5>Additional Information</h5>
                                        <textarea cols="3" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            @foreach($shipping_rules as $shipping_rule)
                                @if($shipping_rule->status === 1)
                                    @if($shipping_rule->type === 'min_cost' && cartSubtotal() >= (float) $shipping_rule->min_cost)
                                        <div class="form-check">
                                            <input class="form-check-input shipping-method" type="radio" data-id="{{ $shipping_rule->cost }}" name="shipping_method" id="shipping_method_{{ $shipping_rule->id }}" value="{{ $shipping_rule->id }}">
                                            <label class="form-check-label" for="shipping_method_{{ $shipping_rule->id }}">{{ $shipping_rule->name }} <span>({{ $shipping_rule->cost }} <i class="{{ $general_settings->currency_icon }}"></i>)</span></label>
                                        </div>
                                    @elseif($shipping_rule->type === 'flat_cost')
                                        <div class="form-check">
                                            <input class="form-check-input shipping-method" type="radio" data-id="{{ $shipping_rule->cost }}" name="shipping_method" id="shipping_method_{{ $shipping_rule->id }}" value="{{ $shipping_rule->id }}">
                                            <label class="form-check-label" for="shipping_method_{{ $shipping_rule->id }}">{{ $shipping_rule->name }} <span>({{ $shipping_rule->cost }} <i class="{{ $general_settings->currency_icon }}"></i>)</span></label>
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{ cartSubtotal() }} <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                                <p>shipping fee: <span id="shipping-fee">0</span> <i class="{{ $general_settings->currency_icon }}"></i></p>
                                <p>discount: <span>{{ cartDiscount() }} <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                                <p><b>total:</b> <span><b id="total_amount" data-id="{{ cartTotal() }}">{{ cartTotal() }}</b> <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                            </div>

                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms">
                                    <label class="form-check-label" for="terms">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>

                            <form action="" id="checkout-form">
                                @csrf

                                <input type="hidden" name="shipping_method_id" id="shipping_method_id" value="" />
                                <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="" />
                            </form>

                            <a href="#" class="common_btn" id="go-checkout">Place Order</a>

                            <a href="{{ route('cart') }}" class="btn btn-outline-secondary mt-5">back to cart</a>
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
            $("input[type=radio]").prop('checked', false);
            $("#shipping_method_id").val('');
            $("#shipping_address_id").val('');
            $("#terms").prop('checked', false);

            $(".shipping-method").on('click', function() {
                let _shipping_fee = $(this).data('id');
                let _current_total_amount = $("#total_amount").data('id');
                let _total_amount = parseFloat(_current_total_amount) + parseFloat(_shipping_fee);

                $("#shipping_method_id").val($(this).val());

                $("#shipping-fee").html(_shipping_fee);

                $("#total_amount").html(_total_amount);
            });

            $(".shipping-address").on('click', function() {
                $("#shipping_address_id").val($(this).val());
            });

            $("#go-checkout").on('click', function(e) {
                e.preventDefault();

                let _shipping_method_id = $("#shipping_method_id").val();
                let _shipping_address_id = $("#shipping_address_id").val();

                if(_shipping_method_id === '') {
                    toastr.error('Please select shipping method');
                    return false;

                }

                if(_shipping_address_id === '') {
                    toastr.error('Please select shipping address');
                    return false;
                }

                if($("#terms").prop('checked') === false) {
                    toastr.error('Please accept terms and conditions');
                    return false;

                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.checkout.submit') }}',
                    data: $("#checkout-form").serialize(),
                    beforeSend: function() {
                        $("#go-checkout").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
                    },
                    success: function(data) {
                        if(data.status === 'success') {
                            window.location.href = data.redirect_url;
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>
@endpush
