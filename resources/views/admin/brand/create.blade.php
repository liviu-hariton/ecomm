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
                            <h4>New brand</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.brand.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to brands</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-brand-form" id="new-brand-form" value="1" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" id="name" class="form-control duplicate-content" data-duplicate-target="slug" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="banner">Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control">

                                    @error('logo')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Featured</label>
                                            <select class="form-control" name="featured" id="featured">
                                                <option value="1" {{ old('featured') === '1' ? 'selected="selected"' : '' }}>Yes</option>
                                                <option value="0" {{ old('featured') === '0' ? 'selected="selected"' : '' }}>No</option>
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
                                <button class="btn btn-success mr-1" type="submit">Create brand <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
