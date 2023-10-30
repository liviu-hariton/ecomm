@extends('vendor.layouts.master')

@section('dashboard-main-content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" action="{{ route('vendor.image-gallery.store') }}" name="" id="" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" />
                            <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendor->id }}" />
                            <input type="hidden" name="status" id="status" value="1" />

                            <input type="hidden" name="new-image-form" id="new-image-form" value="1" />

                            <div class="card-header">
                                <h4>Upload images for product &quot;{{ $product->name }}&quot;</h4>

                                <div class="card-header-action">
                                    <a href="{{ route('vendor.product.edit', $product) }}" class="btn btn-primary"><i class="fa fa-reply"></i> Back to product</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <input type="file" name="images[]" id="images" multiple class="form-control" required>

                                    @if($errors->has('images.*'))
                                        @foreach ($errors->get('images.*') as $error)
                                            <span class="text-danger text-small">{!! implode('<br />', $error) !!}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success mr-1" type="submit">Upload images <i class="fa fa-check-circle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Gallery images</h4>
                        </div>

                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
