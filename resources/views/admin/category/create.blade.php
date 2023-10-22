@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New category</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to categories</a>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="new-category-form" id="new-category-form" value="1" />

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Parent category</label>
                                    <select class="form-control select2" name="parent_id" id="parent_id">
                                        <option value="0">[ROOT]</option>
                                        {!! $categories_tree !!}
                                    </select>

                                    @error('parent_id')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control duplicate-content" data-duplicate-target="slug" value="{{ old('title') }}">

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
                                    <label>Icon</label>
                                    <button name="icon" class="btn btn-primary" data-unselected-class="btn-info" role="iconpicker"></button>

                                    @error('icon')
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
                                <button class="btn btn-success mr-1" type="submit">Create category <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
