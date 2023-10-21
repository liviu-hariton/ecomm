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
                        <form method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-slide-form" id="new-slide-form" value="1" />

                            <div class="card-header">
                                <h4>New slide</h4>

                                <div class="card-header-action">
                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to slides</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="banner">Slide image</label>
                                    <input type="file" name="banner" id="banner" class="form-control">

                                    @error('banner')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}">

                                    @error('type')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">

                                    @error('title')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="starting_price">Starting price</label>
                                    <input type="text" name="starting_price" id="starting_price" class="form-control" value="{{ old('starting_price') }}">

                                    @error('starting_price')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="btn_url">Buton URL</label>
                                    <input type="url" name="btn_url" id="btn_url" class="form-control" value="{{ old('btn_url') }}">

                                    @error('btn_url')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sort_order">Order</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order') }}">

                                    @error('sort_order')
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
                                <button class="btn btn-success mr-1" type="submit">Create slide <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
