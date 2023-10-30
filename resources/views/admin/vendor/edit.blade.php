@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Ecommerce / Vendor profile</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit vendor</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.vendor.destroy', $vendor) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.vendor.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create vendor</a>
                                    <a href="{{ route('admin.vendor.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to vendors</a>
                                    <a href="{{ route('admin.vendor.destroy', $vendor) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete vendor</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.vendor.update', $vendor) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        @if(file_exists($vendor->banner))
                                            <img src="{{ asset($vendor->banner) }}" class="img-fluid" title="{{ $vendor->user->name }}" alt="{{ $vendor->user->name }}" />
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="banner">Banner</label>
                                            <input type="file" name="banner" id="banner" class="form-control">

                                            @error('banner')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="shop_name">Shop name</label>
                                    <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ old('shop_name', $vendor->shop_name) }}">

                                    @error('shop_name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_name">Shop slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $vendor->slug) }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone', $vendor->phone) }}">

                                    @error('phone')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $vendor->email) }}">

                                    @error('email')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $vendor->address) }}">

                                    @error('address')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="summernote" rows="5">{{ old('description', $vendor->description) }}</textarea>

                                    @error('description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $vendor->facebook) }}">

                                            @error('facebook')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $vendor->instagram) }}">

                                            @error('instagram')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $vendor->twitter) }}">

                                            @error('twitter')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Update profile <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
