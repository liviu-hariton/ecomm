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
                            <h4>Create vendor profile</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.vendor.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to vendors</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.vendor.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-vendor-form" id="new-vendor-form" value="1" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_id">User</label>
                                    <select class="form-control select2" name="user_id" id="user_id">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') === $user->id ? 'selected="selected"' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" id="banner" class="form-control">

                                    @error('banner')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="shop_name">Shop name</label>
                                    <input type="text" name="shop_name" id="shop_name" class="form-control duplicate-content" data-duplicate-target="slug" value="{{ old('shop_name') }}">

                                    @error('shop_name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_name">Shop slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">

                                    @error('phone')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">

                                    @error('email')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">

                                    @error('address')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="summernote" rows="5">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook') }}">

                                            @error('facebook')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram') }}">

                                            @error('instagram')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ old('twitter') }}">

                                            @error('twitter')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Create vendor <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
