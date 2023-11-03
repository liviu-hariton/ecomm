@extends('frontend.dashboard.layouts.master')

@section('dashboard-main-content')
    <div class="dashboard_content">
        <h3><i class="fal fa-gift-card"></i> Addresses</h3>
        <div class="wsus__dashboard_add">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="{{ route('user.addresses.create') }}" class="add_address_btn common_btn"><i class="far fa-plus"></i> add new address</a>
                </div>

                @foreach($addresses as $address)
                <div class="col-xl-6">
                    <div class="wsus__dash_add_single" id="address-{{ $address->id }}">
                        <h4>{{ $address->name }} <span>{{ $address->type }}</span></h4>
                        <ul>
                            <li><span>Phone :</span> {{ $address->phone }}</li>
                            <li><span>email :</span> {{ $address->email }}</li>
                            <li><span>country :</span> {{ $address->country }}</li>
                            <li><span>state :</span> {{ $address->state }}</li>
                            <li><span>city :</span> {{ $address->city }}</li>
                            <li><span>zip code :</span> {{ $address->zipcode }}</li>
                            <li><span>address :</span> {{ $address->address }}</li>
                        </ul>
                        <form method="POST" action="{{ route('user.addresses.destroy', $address) }}">
                            @csrf
                            @method('DELETE')
                            <div class="wsus__address_btn">
                                <a href="{{ route('user.addresses.edit', $address) }}" class="edit"><i class="fal fa-edit"></i> edit</a>
                                <a href="{{ route('user.addresses.destroy', $address) }}" onclick="event.preventDefault();this.closest('form').submit();" class="del"><i class="fal fa-trash-alt"></i> delete</a>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
