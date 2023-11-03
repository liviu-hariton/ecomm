<form method="post" action="{{ route('admin.seo-settings-update') }}" name="f-general-settings" id="f-general-settings" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card border">
        <div class="card-header">
            <h4>General settings</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', (!is_null($settings) ? $settings->meta_title : '')) }}">

                @error('meta_title')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description', (!is_null($settings) ? $settings->meta_description : '')) }}">

                @error('meta_description')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="go-settings" class="btn btn-success">Save <i class="fa fa-check-circle"></i></button>
        </div>
    </div>
</form>
