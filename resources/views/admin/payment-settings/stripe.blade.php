<form method="post" action="" name="f-stripe-settings" id="f-stripe-settings" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card border">
        <div class="card-header">
            <h4>Stripe settings</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" name="site_name" id="site_name" class="form-control" value="">

                @error('site_name')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="go-stripe" class="btn btn-success">Save <i class="fa fa-check-circle"></i></button>
        </div>
    </div>
</form>
