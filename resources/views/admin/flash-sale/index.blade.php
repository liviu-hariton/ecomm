@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Flash sale</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash sale settings</h4>
                        </div>

                        <form method="post" action="{{ route('admin.flash-sale.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>End date</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" value="{{ old('end_date', $flash_sale->end_date) }}">

                                            @error('end_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Save <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add products</h4>
                        </div>

                        <form method="post" action="{{ route('admin.flash-sale.add-products') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="products">Choose products</label>
                                    <select class="form-control select2" name="products[]" id="products" multiple placeholder="Choose products">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    </select>

                                    @error('products')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Add products <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash sale products</h4>

                            <div class="card-header-action">

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
