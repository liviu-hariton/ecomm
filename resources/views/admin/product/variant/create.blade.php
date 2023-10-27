@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Products / Variants</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New variant for &quot;{{ $product->name }}&quot;</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.variant.index', ['pid' => $product->id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to variants</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.variant.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-variant-form" id="new-variant-form" value="1" />
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
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
                                <button class="btn btn-success mr-1" type="submit">Create variant <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
