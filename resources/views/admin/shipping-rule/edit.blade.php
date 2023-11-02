@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Shipping rules</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit rule</h4>

                            <div class="card-header-action">
                                <form method="POST" action="{{ route('admin.shipping-rules.destroy', $shippingRule) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.shipping-rules.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create rule</a>
                                    <a href="{{ route('admin.shipping-rules.index') }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to rules</a>
                                    <a href="{{ route('admin.shipping-rules.destroy', $shippingRule) }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-danger"><i class="fa fa-trash"></i> Delete rule</a>
                                </form>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.shipping-rules.update', $shippingRule) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $shippingRule->name) }}">

                                    @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shipping-type">Type</label>
                                    <select class="form-control" name="type" id="shipping-type">
                                        <option value="flat_cost" {{ old('type', $shippingRule->type) === 'flat_cost' ? 'selected="selected"' : '' }}>Flat cost</option>
                                        <option value="min_cost" {{ old('type', $shippingRule->type) === 'min_cost' ? 'selected="selected"' : '' }}>Minimum order amount</option>
                                    </select>

                                    @error('type')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ old('type', $shippingRule->type) === 'flat_cost' ? 'd-none' : '' }}" id="min_cost_container">
                                    <label for="min_cost">Minimum amount</label>
                                    <input type="number" min="0.00" step=".01" name="min_cost" id="min_cost" class="form-control" value="{{ old('min_cost', $shippingRule->min_cost) }}">

                                    @error('min_cost')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cost">Cost</label>
                                    <input type="number" min="0.00" step=".01" name="cost" id="cost" class="form-control" value="{{ old('cost', $shippingRule->cost) }}">

                                    @error('cost')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $shippingRule->status === 1 ? 'selected="selected"' : '' }}>Active</option>
                                        <option value="0" {{ $shippingRule->status === 0 ? 'selected="selected"' : '' }}>Inactive</option>
                                    </select>

                                    @error('status')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Save rule <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '#shipping-type', function() {
                let _shipping_type = $(this).val();

                if(_shipping_type === 'flat_cost') {
                    $("#min_cost_container").addClass('d-none');
                } else {
                    $("#min_cost_container").removeClass('d-none');
                }
            });
        });
    </script>
@endpush
