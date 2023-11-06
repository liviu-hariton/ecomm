<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url('{{ asset('frontend/images/flash_sell_bg.jpg') }}')">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown flash-sale-countdown"></div>
                        <a class="common_btn" href="{{ route('flash-sale') }}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        @if(count($flash_sale->carouselItems) > 0)
        <div class="row flash_sell_slider">
            @foreach($flash_sale->carouselItems as $carousel_item)
            <x-products.v1 :data="$carousel_item"></x-products.v1>
            @endforeach
        </div>
        @endif
    </div>
</section>

@foreach($flash_sale->carouselItems as $carousel_item)
    <x-products.modal :data="$carousel_item"></x-products.modal>
@endforeach

@push('scripts')
<script>
    $(document).ready(function() {
        simplyCountdown('.flash-sale-countdown', {
            year: {{ date('Y', strtotime($flash_sale->end_date)) }},
            month: {{ date('m', strtotime($flash_sale->end_date)) }},
            day: {{ date('d', strtotime($flash_sale->end_date)) }},
            hours: {{ date('H', strtotime($flash_sale->end_date)) }},
            minutes: {{ date('i', strtotime($flash_sale->end_date)) }}
        });
    });
</script>
@endpush
