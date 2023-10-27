@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Products / Variants / Items</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New item for &quot;{{ $variant->name }}&quot; variant of &quot;{{ $variant->product->name }}&quot;</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.item.index', ['vid' => $variant->id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to variant items</a>
                                <a href="{{ route('admin.product.edit', $variant->product) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to product</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.item.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="product_variant_id" id="product_variant_id" value="{{ $variant->id }}" />
                            <input type="hidden" name="product_id" id="product_id" value="{{ $variant->product->id }}" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Item name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" min="0.00" step=".01" name="price" id="price" class="form-control" value="{{ old('price', $variant->product->price) }}">

                                    @error('price')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="checkbox" name="is_default" id="is_default" value="1" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Default</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ old('status') === '1' ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ old('status') === '0' ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Create variant item <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
