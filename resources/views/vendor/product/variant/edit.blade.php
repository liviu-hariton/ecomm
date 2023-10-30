@extends('vendor.layouts.master')

@section('dashboard-main-content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit variant for &quot;{{ $variant->product->name }}&quot;</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('vendor.variant.destroy', $variant) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('vendor.variant.create', ['pid' => $variant->product_id]) }}" class="btn btn-success"><i class="fa fa-plus"></i> New variant</a>
                                    <a href="{{ route('vendor.variant.index', ['pid' => $variant->product_id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to variants</a>
                                    <a href="{{ route('vendor.product.edit', $variant->product) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to product</a>
                                    <a href="{{ route('vendor.variant.destroy', $variant) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete variant</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('vendor.variant.update', $variant) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $variant->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $variant->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $variant->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Update variant <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
