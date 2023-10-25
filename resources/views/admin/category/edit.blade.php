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
                            <h4>Edit category</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.category.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create category</a>
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to categories</a>
                                    <a href="{{ route('admin.category.destroy', $category) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete category</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.category.update', $category) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Parent category</label>
                                    <select class="form-control select2" name="parent_id" id="parent_id">
                                        <option value="">[ROOT]</option>
                                        {!! $categories_tree !!}
                                    </select>

                                    @error('parent_id')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('title', $category->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}">

                                    @error('slug')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Icon</label>
                                    <button name="icon" class="btn btn-primary" data-icon="{{ $category->icon }}" data-unselected-class="btn-info" role="iconpicker"></button>

                                    @error('icon')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ old('status', $category->status) === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $category->status) === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Save category <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
