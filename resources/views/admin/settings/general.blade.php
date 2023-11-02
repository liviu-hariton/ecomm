<form method="post" action="{{ route('admin.general-settings-update') }}" name="f-general-settings" id="f-general-settings" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card border">
        <div class="card-header">
            <h4>General settings</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" name="site_name" id="site_name" class="form-control" value="{{ old('site_name', (!is_null($settings) ? $settings->site_name : '')) }}">

                @error('site_name')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="layout">Layout</label>
                <select class="form-control" name="layout" id="layout">
                    <option value="ltr" {{ (!is_null($settings) && $settings->layout === 'ltr' ? 'selected="selected"' : '') }}>Left to Right</option>
                    <option value="rtl" {{ (!is_null($settings) && $settings->layout === 'rtl' ? 'selected="selected"' : '') }}>Right to Left</option>
                </select>

                @error('layout')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="contact_email">Contact email</label>
                <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email', (!is_null($settings) ? $settings->contact_email : '')) }}">

                @error('contact_email')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="layout">Default currency</label>
                <select class="form-control select2" name="currency_name" id="currency_name">
                    @foreach(config('settings.currencies_list') as $currency)
                    <option value="{{ $currency['code'] }}" {{ (!is_null($settings) && $settings->currency_name === $currency['code'] ? 'selected="selected"' : '') }}>{{ $currency['code'] }} - {{ $currency['name'] }} {{ $currency['symbol'] !== '' ? '('.$currency['symbol'].')' : '' }}</option>
                    @endforeach
                </select>

                @error('layout')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Currency Icon</label>
                <button name="currency_icon" data-icon="{{ (!is_null($settings) ? $settings->currency_icon : '') }}" class="btn btn-primary" data-unselected-class="btn-info" role="iconpicker"></button>

                @error('currency_icon')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="layout">Timezone</label>
                <select class="form-control select2" name="timezone" id="timezone">
                    @foreach(config('settings.timezones') as $timezone_key=>$timezone_name)
                    <option value="{{ $timezone_key }}" {{ (!is_null($settings) && $settings->timezone === $timezone_key ? 'selected="selected"' : '') }}>{{ $timezone_name }}</option>
                    @endforeach
                </select>

                @error('timezone')
                <span class="text-danger text-small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="go-settings" class="btn btn-success">Save <i class="fa fa-check-circle"></i></button>
        </div>
    </div>
</form>
