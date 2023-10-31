@extends('frontend.layouts.master')

@section('main-content')
<section id="wsus__daily_deals">
    <div class="container">
        <div class="wsus__offer_details_area">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header rounded-0">
                        <h3>flash sell</h3>
                        <div class="wsus__offer_countdown">
                            <span class="end_text">ends time :</span>
                            <div class="simply-countdown flash-sale-countdown"></div>
                        </div>
                    </div>
                </div>
            </div>

            @if(count($flash_sale_items->items()) > 0)
            <div class="row">
                @foreach($flash_sale_items->items() as $carousel_item)
                <x-products.v2 :data="$carousel_item"></x-products.v2>
                @endforeach
            </div>
            @endif

            @if($flash_sale_items->hasPages())
                {{ $flash_sale_items->links() }}
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown('.flash-sale-countdown', {
                year: {{ date('Y', strtotime($flash_sale->end_date)) }},
                month: {{ date('m', strtotime($flash_sale->end_date)) }},
                day: {{ date('d', strtotime($flash_sale->end_date)) }},
                hours: {{ date('H', strtotime($flash_sale->end_date)) }},
                minutes: {{ date('i', strtotime($flash_sale->end_date)) }},
                enableUtc: true
            });
        });
    </script>
@endpush
