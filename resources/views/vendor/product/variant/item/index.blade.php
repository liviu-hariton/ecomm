@extends('vendor.layouts.master')

@section('dashboard-main-content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Items for &quot;{{ $variant->name }}&quot; variant of &quot;{{ $variant->product->name }}&quot;</h4>

                            <div class="card-header-action">
                                <a href="{{ route('vendor.item.create', ['vid' => $variant->id]) }}" class="btn btn-success"><i class="fa fa-plus"></i> Create variant item</a>
                                <a href="{{ route('vendor.variant.index', ['pid' => $variant->product->id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to variants</a>
                                <a href="{{ route('vendor.product.edit', $variant->product) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to product</a>
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

