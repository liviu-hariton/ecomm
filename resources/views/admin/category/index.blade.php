@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            @if(Route::currentRouteName() !== 'admin.category.show')
                <h1>Categories</h1>
            @else
                <h1>{{ $category->name }}</h1>
            @endif
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Route::currentRouteName() !== 'admin.category.show')
                                <h4>Categories list</h4>
                            @else
                                <h4>Subcategories list</h4>
                            @endif

                            <div class="card-header-action">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create category</a>
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
