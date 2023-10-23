@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Products / Brands</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit brand</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.brand.destroy', $brand) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.brand.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create brand</a>
                                    <a href="{{ route('admin.brand.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to brands</a>
                                    <a href="{{ route('admin.brand.destroy', $brand) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete brand</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.brand.update', $brand) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $brand->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $brand->slug) }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        @if(file_exists($brand->logo))
                                            <img src="{{ asset($brand->logo) }}" class="img-fluid" title="{{ $brand->name }}" alt="{{ $brand->name }}" />
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="banner">Logo</label>
                                            <input type="file" name="logo" id="logo" class="form-control">

                                            @error('logo')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Featured</label>
                                            <select class="form-control" name="featured" id="featured">
                                                <option value="1" {{ $brand->featured === 1 ? 'selected="selected"' : '' }}>Yes</option>
                                                <option value="0" {{ $brand->featured === 0 ? 'selected="selected"' : '' }}>No</option>
                                            </select>

                                            @error('featured')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" {{ $brand->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                                <option value="0" {{ $brand->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                            </select>

                                            @error('status')
                                            <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Create brand <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
