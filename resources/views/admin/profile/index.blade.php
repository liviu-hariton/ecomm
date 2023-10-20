@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf

                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="mb-3">
                                            <img src="{{ asset(auth()->user()->image) }}" class="avatar avatar-xl" />
                                        </div>

                                        <label>Profile image</label>
                                        <input type="file" name="image" class="form-control">

                                        @error('image')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required="">

                                        @error('name')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required="">

                                        @error('email')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card">
                        <form method="post" action="{{ route('admin.password.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf

                            <div class="card-header">
                                <h4>Update password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Current password</label>
                                        <input type="password" name="current_password" class="form-control" value="" required="">

                                        @error('current_password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label>New password</label>
                                        <input type="password" name="password" class="form-control" value="" required="">

                                        @error('password')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Confirm password</label>
                                        <input type="password" name="password_confirmation" class="form-control" value="" required="">

                                        @error('password_confirmation')
                                        <span class="text-danger text-small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
