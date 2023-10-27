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
                            <h4>Edit item for &quot;{{ $variant_item->product_variant->name }}&quot; variant of &quot;{{ $variant_item->product->name }}&quot;</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.product-variant-item.destroy', ['viid' => $variant_item->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.product-variant-item.create', ['vid' => $variant_item->product_variant_id]) }}" class="btn btn-success"><i class="fa fa-plus"></i> Create variant item</a>
                                    <a href="{{ route('admin.product-variant-item.index', ['vid' => $variant_item->product_variant_id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to variant items</a>
                                    <a href="{{ route('admin.product.edit', $variant_item->product) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to product</a>
                                    <a href="{{ route('admin.product-variant-item.destroy', ['viid' => $variant_item->id]) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete variant item</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.product-variant-item.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="product_variant_id" id="product_variant_id" value="{{ $variant_item->product_variant_id }}" />
                            <input type="hidden" name="product_id" id="product_id" value="{{ $variant_item->product_id }}" />
                            <input type="hidden" name="id" id="id" value="{{ $variant_item->id }}" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Item name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $variant_item->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" min="0.00" step=".01" name="price" id="price" class="form-control" value="{{ old('price', $variant_item->price) }}">

                                    @error('price')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="checkbox" {{ $variant_item->is_default === 1 ? 'checked="checked"' : '' }} name="is_default" id="is_default" value="1" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Default</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $variant_item->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $variant_item->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Update variant item <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
