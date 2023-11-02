@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Coupons</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Coupon</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to coupons</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.coupons.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

                                            @error('name')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}">

                                            @error('code')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ old('qty', '0') }}">

                                            @error('qty')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="max_use">Uses / person</label>
                                            <input type="number" min="0" name="max_use" id="max_use" class="form-control" value="{{ old('max_use', '0') }}">

                                            @error('max_use')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="start_date">Start date</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" value="{{ old('start_date') }}">

                                            @error('start_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="end_date">End date</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" value="{{ old('end_date') }}">

                                            @error('end_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="discount_type">Discount type</label>
                                            <select class="form-control" name="discount_type" id="discount_type">
                                                <option value="percentage" {{ old('status') === 'percentage' ? 'selected="selected"' : '' }}>Percentage (%)</option>
                                                <option value="fixed" {{ old('status') === 'fixed' ? 'selected="selected"' : '' }}>Fixed ({{ $general_settings->currency_name }})</option>
                                            </select>

                                            @error('discount_type')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="discount_amount">Discount amount</label>
                                            <input type="number" min="0.00" step=".01" name="discount_amount" id="discount_amount" class="form-control" value="{{ old('discount_amount', '0.00') }}">

                                            @error('discount_amount')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ old('status') === '1' ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ old('status') === '0' ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Create coupon <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
