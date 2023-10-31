@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Products list @if(!is_null($vendor)) for {{ $vendor->shop_name }} @endif</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create product</a>

                                @if(!is_null($vendor))
                                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to all products</a>
                                @endif
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
