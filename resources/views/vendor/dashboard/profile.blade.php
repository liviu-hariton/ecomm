@extends('vendor.dashboard.layouts.master')

@section('dashboard-main-content')
<div class="wsus__dashboard">
    <div class="row">
        <div class="col-12">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-user"></i> profile</h3>

                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">
                        <h4>basic information</h4>

                        <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-md-6">
                                    <div class="wsus__dash_pro_img">
                                        <img src="{{ asset(auth()->user()->image ?? 'backend/assets/img/avatar/avatar-1.png') }}" alt="{{ auth()->user()->name }}" class="img-fluid w-100">
                                        <input type="file" name="image" id="image" />
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name', auth()->user()->name) }}">
                                            </div>

                                            @error('name')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fal fa-envelope-open"></i>
                                                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                            </div>

                                            @error('email')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <button class="common_btn mt-4" type="submit">update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="wsus__dash_pro_area mt-3">
                        <form method="post" action="{{ route('user.profile.update.password') }}">
                            @csrf

                            <div class="wsus__dash_pass_change mt-2">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fas fa-unlock-alt"></i>
                                            <input type="password" name="current_password" value="" required placeholder="Current Password">
                                        </div>

                                        @error('current_password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fas fa-lock-alt"></i>
                                            <input type="password" name="password" value="" required placeholder="New Password">
                                        </div>

                                        @error('password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="wsus__dash_pro_single">
                                            <i class="fas fa-lock-alt"></i>
                                            <input type="password" name="password_confirmation" value="" required placeholder="Confirm Password">
                                        </div>

                                        @error('password_confirmation')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12">
                                        <button class="common_btn" type="submit">update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
