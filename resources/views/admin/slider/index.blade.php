@extends('admin.layouts.master')

@section('main-section')
    <section class="section">
        <div class="section-header">
            <h1>Home Slider</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Slides list</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.slider.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create slide</a>
                            </div>
                        </div>

                        <div class="card-body">

                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
