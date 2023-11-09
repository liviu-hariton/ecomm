<form method="post" action="{{ route('admin.paypal-settings.update', 1) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card border">
        <div class="card-header">
            <h4>Paypal settings</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="text" name="client_id" id="client_id" class="form-control" value="{{ old('client_id', $paypal_settings->client_id ?? '') }}">

                        @error('client_id')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="secret_key">Secret Key</label>
                        <input type="text" name="secret_key" id="secret_key" class="form-control" value="{{ old('secret_key', $paypal_settings->secret_key ?? '') }}">

                        @error('secret_key')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{ !is_null($paypal_settings) && $paypal_settings->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                            <option value="0" {{ !is_null($paypal_settings) && $paypal_settings->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                        </select>

                        @error('status')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="mode">Mode</label>
                        <select class="form-control" name="mode" id="mode">
                            <option value="live" {{ !is_null($paypal_settings) && $paypal_settings->mode === 'live' ? 'selected="selected"' : '' }}>Live</option>
                            <option value="sandbox" {{ !is_null($paypal_settings) && $paypal_settings->mode === 'sandbox' ? 'selected="selected"' : '' }}>Sandbox</option>
                        </select>

                        @error('mode')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control select2" name="country" id="country">
                            @foreach(config('settings.countries') as $country)
                                <option value="{{ $country }}" {{ !is_null($paypal_settings) && $paypal_settings->country === $country ? 'selected="selected"' : '' }}>{{ $country }}</option>
                            @endforeach
                            <option value=""></option>
                        </select>

                        @error('country')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="layout">Default currency</label>
                        <select class="form-control select2" name="currency" id="currency">
                            @foreach(config('settings.currencies_list') as $currency)
                                <option value="{{ $currency['code'] }}" {{ !is_null($paypal_settings) && $paypal_settings->currency === $currency['code'] ? 'selected="selected"' : '' }}>{{ $currency['code'] }} - {{ $currency['name'] }} {{ $currency['symbol'] !== '' ? '('.$currency['symbol'].')' : '' }}</option>
                            @endforeach
                        </select>

                        @error('currency')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="currency_rate">Currency rate (per USD)</label>
                        <input type="number" min="0.00" step=".01" name="currency_rate" id="currency_rate" class="form-control" value="{{ old('secret_key', $paypal_settings->currency_rate ?? '') }}">

                        @error('currency_rate')
                        <span class="text-danger text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Save <i class="fa fa-check-circle"></i></button>
        </div>
    </div>
</form>
