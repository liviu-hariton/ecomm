@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Payment Settings</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-paypal-list" data-toggle="list" href="#list-paypal" role="tab">PayPal&reg; settings</a>
                                        <a class="list-group-item list-group-item-action" id="list-stripe-list" data-toggle="list" href="#list-stripe" role="tab">Stripe&reg; settings</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="list-paypal" role="tabpanel" aria-labelledby="list-paypal-list">
                                            @include('admin.payment-settings.paypal')
                                        </div>
                                        <div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
                                            @include('admin.payment-settings.stripe')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
