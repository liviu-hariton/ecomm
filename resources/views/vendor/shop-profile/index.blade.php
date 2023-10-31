@extends('vendor.layouts.master')

@section('dashboard-main-content')
    <div class="wsus__dashboard">
        <div class="row">
            <div class="col-12">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i> Shop profile</h3>

                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <form method="post" action="{{ route('vendor.shop-profile.update', $vendor) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-3">
                                        @if(file_exists($vendor->banner))
                                            <img src="{{ asset($vendor->banner) }}" class="img-fluid" title="{{ $vendor->user->name }}" alt="{{ $vendor->user->name }}" />
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="wsus__dash_pro_single">
                                            <i class="far fa-image"></i>
                                            <input type="file" name="banner" id="banner">

                                            @error('banner')
                                            <br /><span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="wsus__dash_pro_single">
                                    <i class="far fa-store-alt"></i>
                                    <input type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', $vendor->shop_name) }}">

                                    @error('shop_name')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="wsus__dash_pro_single">
                                    <i class="far fa-globe"></i>
                                    <input type="text" name="slug" id="shop_name" value="{{ old('slug', $vendor->slug) }}">

                                    @error('slug')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="wsus__dash_pro_single">
                                    <i class="far fa-phone-alt"></i>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $vendor->phone) }}">

                                    @error('phone')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-envelope-open"></i>
                                    <input type="email" name="email" id="email" value="{{ old('email', $vendor->email) }}">

                                    @error('email')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-building"></i>
                                    <input type="text" name="address" id="address" value="{{ old('address', $vendor->address) }}">

                                    @error('address')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="wsus__dash_pro_single">
                                    <textarea name="description" id="description" class="summernote" rows="5" placeholder="About you">{{ old('description', $vendor->description) }}</textarea>

                                    @error('description')
                                    <br /><span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-facebook"></i>
                                            <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $vendor->facebook) }}">

                                            @error('facebook')
                                            <br /><span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-instagram"></i>
                                            <br /><input type="url" name="instagram" id="instagram" value="{{ old('instagram', $vendor->instagram) }}">

                                            @error('instagram')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fab fa-twitter"></i>
                                            <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $vendor->twitter) }}">

                                            @error('twitter')
                                            <br /><span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button class="common_btn" type="submit">Update profile <i class="fa fa-check-circle"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
