@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Ecommerce / Vendors</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Brands list</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.vendor.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create vendor</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
