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
                            <h4>Edit Coupon</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create coupon</a>
                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to coupons</a>
                                    <a href="{{ route('admin.coupons.destroy', $coupon) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete coupon</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.coupons.update', $coupon) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $coupon->name) }}">

                                            @error('name')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="code">Code</label>
                                            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $coupon->code) }}">

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
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ old('qty', $coupon->qty) }}">

                                            @error('qty')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="max_use">Uses / person</label>
                                            <input type="number" min="0" name="max_use" id="max_use" class="form-control" value="{{ old('max_use', $coupon->max_use) }}">

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
                                            <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" value="{{ old('start_date', $coupon->start_date) }}">

                                            @error('start_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="end_date">End date</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" value="{{ old('end_date', $coupon->end_date) }}">

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
                                                <option value="percentage" {{ $coupon->discount_type === 'percentage' ? 'selected="selected"' : '' }}>Percentage (%)</option>
                                                <option value="fixed" {{ $coupon->discount_type === 'fixed' ? 'selected="selected"' : '' }}>Fixed ({{ $general_settings->currency_name }})</option>
                                            </select>

                                            @error('discount_type')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="discount_amount">Discount amount</label>
                                            <input type="number" min="0.00" step=".01" name="discount_amount" id="discount_amount" class="form-control" value="{{ old('discount_amount', $coupon->discount_amount) }}">

                                            @error('discount_amount')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $coupon->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $coupon->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Update coupon <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
