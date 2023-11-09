@extends('frontend.layouts.master')

@section('main-content')
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal"
                                        aria-selected="true">PayPal</button>
                                <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-stripe" type="button" role="tab"
                                        aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="sticky_sidebar">
                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                 aria-labelledby="v-pills-paypal-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            <a href="{{ route('user.paypal.payment') }}" class="common_btn">Pay with PayPal&reg;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-stripe" role="tabpanel"
                                 aria-labelledby="v-pills-stripe-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="wsus__payment_area">
                                            Stripe&reg; is the faster, safer way to send money, make an online payment,
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Payment Summary</h5>
                            <p>subtotal: <span>{{ cartSubtotal() }} <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                            <p>shipping fee: <span>{{ cartShippingFee() }} <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                            <p>discount: <span>{{ cartDiscount() }} <i class="{{ $general_settings->currency_icon }}"></i></span></p>
                            <h6>total <span>{{ cartTotalWithShipping() }} <i class="{{ $general_settings->currency_icon }}"></i></span></h6>

                            <div class="wsus__minicart_btn_area mt-5">
                                <a class="common_btn" href="{{ route('cart') }}">back to cart</a>
                                <a class="common_btn" href="{{ route('user.checkout') }}">back to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
