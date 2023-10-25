@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Products / Images gallery</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update image in &quot;{{ $image_gallery->product->name }}&quot; gallery</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.image-gallery.destroy', $image_gallery) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.image-gallery.index', ['pid' => $image_gallery->product_id]) }}" class="btn btn-success"><i class="fa fa-plus"></i> Upload image</a>
                                    <a href="{{ route('admin.image-gallery.index', ['pid' => $image_gallery->product_id]) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to gallery</a>
                                    <a href="{{ route('admin.image-gallery.destroy', $image_gallery) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete image</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.image-gallery.update', $image_gallery) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        @if(file_exists($image_gallery->image))
                                            <img src="{{ asset($image_gallery->image) }}" class="img-fluid" title="{{ $image_gallery->title }}" alt="{{ $image_gallery->alt }}" />
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="banner">Image</label>
                                            <input type="file" name="image" id="image" class="form-control">

                                            @error('image')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $image_gallery->title) }}">

                                    @error('title')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alt">Alt</label>
                                    <input type="text" name="alt" id="alt" class="form-control" value="{{ old('alt', $image_gallery->alt) }}">

                                    @error('alt')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sort_order">Order</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $image_gallery->sort_order) }}">

                                    @error('sort_order')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $image_gallery->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $image_gallery->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Save image <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
