@if(count($top_slides) > 0)
    <section id="wsus__banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__banner_content">
                        <div class="row banner_slider">
                            @foreach($top_slides as $top_slide)
                                <div class="col-xl-12">
                                    <div class="wsus__single_slider" style="background: url('{{ asset($top_slide->banner) }}');">
                                        <div class="wsus__single_slider_text">
                                            <h3>{{ $top_slide->type }}</h3>
                                            <h1>{{ $top_slide->title }}</h1>
                                            <h6>start at ${{ $top_slide->starting_price }}</h6>
                                            <a class="common_btn" href="{{ $top_slide->btn_url }}">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
