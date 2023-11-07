@extends('frontend.dashboard.layouts.master')

@section('dashboard-main-content')
    <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="fal fa-gift-card"></i>create address</h3>
        <div class="wsus__dashboard_add wsus__add_address">
            <form method="post" action="{{ route('user.addresses.store') }}" name="f-new-address" id="f-new-address" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>name <b>*</b></label>
                            <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                        </div>

                        @error('name')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>email</label>
                            <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                        </div>

                        @error('email')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>phone <b>*</b></label>
                            <input type="tel" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
                        </div>

                        @error('phone')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>country <b>*</b></label>
                            <div class="wsus__topbar_select">
                                <select class="select_2" name="country" name="country">
                                    @foreach(config('settings.countries') as $country)
                                    <option value="{{ $country }}" {{ old('country') === $country ? 'selected="selected"' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @error('country')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>state <b>*</b></label>
                            <input type="text" name="state" id="state" placeholder="State" value="{{ old('state') }}">
                        </div>

                        @error('state')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>city <b>*</b></label>
                            <input type="text" name="city" id="city" placeholder="City" value="{{ old('city') }}">
                        </div>

                        @error('city')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>Address <b>*</b></label>
                            <input type="text" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
                        </div>

                        @error('address')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>zip code <b>*</b></label>
                            <input type="text" name="zipcode" id="zipcode" placeholder="Zip Code" value="{{ old('zipcode') }}">
                        </div>

                        @error('zipcode')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <div class="wsus__add_address_single">
                            <label>address type <b>*</b></label>
                            <input type="text" name="type" id="type" placeholder="Home / Office / others" value="{{ old('type') }}">
                        </div>

                        @error('type')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
