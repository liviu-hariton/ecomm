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
                            <h4>Edit product</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.product.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.product.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create product</a>
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to products</a>
                                    <a href="{{ route('admin.image-gallery.index', ['pid' => $product->id]) }}" class="btn btn-info"><i class="fa fa-images"></i> Images gallery</a>
                                    <a href="{{ route('admin.variant.index', ['pid' => $product->id]) }}" class="btn btn-secondary"><i class="fa fa-th-list"></i> Variants</a>
                                    <a href="{{ route('admin.product.destroy', $product) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete product</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.product.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="section-title">About</div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="summernote" rows="5">{{ old('short_description', $product->short_description) }}</textarea>

                                    @error('short_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="long_description">Long Description</label>
                                    <textarea name="long_description" id="long_description" class="summernote" rows="5">{{ old('long_description', $product->long_description) }}</textarea>

                                    @error('long_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        @if(file_exists($product->image))
                                            <img src="{{ asset($product->image) }}" class="img-fluid" title="{{ $product->name }}" alt="{{ $product->name }}" />
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="image">Main image</label>
                                            <input type="file" name="image" id="image" class="form-control">

                                            @error('image')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="video_link">Video URL</label>
                                    <input type="url" name="video_link" id="video_link" class="form-control" value="{{ old('video_link', $product->video_link) }}">

                                    @error('video_link')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control select2" name="category_id" id="category_id">
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
                                            <select class="form-control select2" name="brand_id" id="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) === $brand->id ? 'selected="selected"' : '' }}>{{ $brand->name }}</option>
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
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $product->slug) }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}">

                                    @error('meta_title')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description', $product->meta_description) }}">

                                    @error('meta_description')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="section-title">Commercial</div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" min="0.00" step=".01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">

                                            @error('price')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ old('qty', $product->qty) }}">

                                            @error('qty')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku', $product->sku) }}">

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
                                            <input type="number" min="0.00" step=".01" name="offer_price" id="offer_price" class="form-control" value="{{ old('offer_price', $product->offer_price) }}">

                                            @error('offer_price')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Offer start date</label>
                                            <input type="text" name="offer_start_date" id="offer_start_date" class="form-control datetimepicker" value="{{ old('offer_start_date', $product->offer_start_date) }}">

                                            @error('offer_start_date')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Offer end date</label>
                                            <input type="text" name="offer_end_date" id="offer_end_date" class="form-control datetimepicker" value="{{ old('offer_end_date', $product->offer_end_date) }}">

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
                                            <input type="checkbox" name="is_top" id="is_top" {{ $product->is_top == 1 ? 'checked="checked"' : '' }} value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Top</span>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="is_best" id="is_best" {{ $product->is_best == 1 ? 'checked="checked"' : '' }} value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Best</span>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="is_featured" id="is_featured" {{ $product->is_featured == 1 ? 'checked="checked"' : '' }} value="1" class="custom-switch-input">
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
                                                <option value="1" {{ $product->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                                <option value="0" {{ $product->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                            </select>

                                            @error('status')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="approved">Approved</label>
                                            <select class="form-control" name="approved" id="approved">
                                                <option value="1" {{ $product->approved === 1 ? 'selected="selected"' : '' }}>Yes</option>
                                                <option value="0" {{ $product->approved === 0 ? 'selected="selected"' : '' }}>No</option>
                                            </select>

                                            @error('status')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Update product <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
