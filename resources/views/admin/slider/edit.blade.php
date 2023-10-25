@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Home Slider</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit slide</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.slider.destroy', $slider) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.slider.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create slide</a>
                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to slides</a>
                                    <a href="{{ route('admin.slider.destroy', $slider) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete slide</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.slider.update', $slider) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        @if(!is_null($slider->type) && file_exists($slider->banner))
                                            <img src="{{ asset($slider->banner) }}" class="img-fluid" title="{{ $slider->title }}" alt="{{ $slider->title }}" />
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="banner">Slide image</label>
                                            <input type="file" name="banner" id="banner" class="form-control">

                                            @error('banner')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="type">Type</label>
                                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $slider->type) }}">

                                    @error('type')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $slider->title) }}">

                                    @error('title')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="starting_price">Starting price</label>
                                    <input type="text" name="starting_price" id="starting_price" class="form-control" value="{{ old('starting_price', $slider->starting_price) }}">

                                    @error('starting_price')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="btn_url">Buton URL</label>
                                    <input type="text" name="btn_url" id="btn_url" class="form-control" value="{{ old('btn_url', $slider->btn_url) }}">

                                    @error('btn_url')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sort_order">Order</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order) }}">

                                    @error('sort_order')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $slider->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $slider->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Save slide <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
