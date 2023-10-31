@extends('vendor.layouts.master')

@section('dashboard-main-content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New product</h4>

                            <div class="card-header-action">
                                <a href="{{ route('vendor.product.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to products</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('vendor.product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-product-form" id="new-product-form" value="1" />

                            <div class="card-body">
                                <div class="section-title">About</div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control duplicate-content" data-duplicate-target="slug" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="summernote" rows="5">{{ old('short_description') }}</textarea>

                                    @error('short_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="long_description">Long Description</label>
                                    <textarea name="long_description" id="long_description" class="summernote" rows="5">{{ old('long_description') }}</textarea>

                                    @error('long_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Main image</label>
                                    <input type="file" name="image" id="image" class="form-control">

                                    @error('image')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="video_link">Video URL</label>
                                    <input type="url" name="video_link" id="video_link" class="form-control" value="{{ old('video_link') }}">

                                    @error('video_link')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control select_2" name="category_id" id="category_id">
                                                {!! $categories_tree !!}
                                            </select>

                                            @error('category_id')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="brand_id">Brand</label>
                                            <select class="form-control select_2" name="brand_id" id="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id') === $brand->id ? 'selected="selected"' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('brand_id')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title">SEO</div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title') }}">

                                    @error('meta_title')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description') }}">

                                    @error('meta_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="section-title">Commercial</div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" min="0.00" step=".01" name="price" id="price" class="form-control" value="{{ old('price', '0.00') }}">

                                            @error('price')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ old('qty', '0') }}">

                                            @error('qty')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" name="sku" id="sku" class="form-control" value="SKU-{{ old('sku', $sku) }}">

                                            @error('sku')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title">Promotion</div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="price">Offer price</label>
                                            <input type="number" min="0.00" step=".01" name="offer_price" id="offer_price" class="form-control" value="{{ old('offer_price', '0.00') }}">

                                            @error('offer_price')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Offer start date</label>
                                            <input type="text" name="offer_start_date" id="offer_start_date" class="form-control datetimepicker" value="{{ old('offer_start_date') }}">

                                            @error('offer_start_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Offer end date</label>
                                            <input type="text" name="offer_end_date" id="offer_end_date" class="form-control datetimepicker" value="{{ old('offer_end_date') }}">

                                            @error('offer_end_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title">Options</div>

                                <div class="row mt-4 mb-3">
                                    <div class="col-4">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="is_top" id="is_top" value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Top</span>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="is_best" id="is_best" value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Best</span>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="is_featured" id="is_featured" value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Featured</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
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
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Create product <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
