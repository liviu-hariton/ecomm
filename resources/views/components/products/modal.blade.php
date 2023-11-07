<section class="product_popup_modal">
    <div class="modal fade" id="product-quick-view-{{ $data->product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if($data->product->video_link)
                                <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video" href="{{ $data->product->video_link }}">
                                    <i class="fas fa-play"></i>
                                </a>
                                @endif
                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($data->product->image) }}" alt="{{ $data->product->name }}" class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @if(count($data->product->images) > 0)
                                    @foreach($data->product->images as $image)
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($image->image) }}" alt="{{ $data->product->name }}" class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($data->product->image) }}" alt="{{ $data->product->name }}" class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="{{ route('product', $data->product) }}">{{ $data->product->name }}</a>
                                <p class="wsus__stock_area">
                                    @if($data->product->qty > 0)
                                    <span class="in_stock">in stock</span>
                                    @endif

                                    ({{ $data->product->qty }} item)
                                </p>

                                <h4>
                                    {{ productPrice($data->product) }} <i class="{{ $general_settings->currency_icon }}"></i>

                                    @if(productHasDiscount($data->product) === true)
                                        <del>{{ $data->product->price }} <i class="{{ $general_settings->currency_icon }}"></i></del>
                                    @endif
                                </h4>

                                <p class="review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>20 review</span>
                                </p>

                                <div class="description">
                                    {!! $data->product->short_description !!}
                                </div>

                                @if(productHasDiscount($data->product) === true)
                                    <div class="wsus_pro_hot_deals">
                                        <h5>offer active until : </h5>
                                        <div class="simply-countdown product-offer-countdown"></div>
                                    </div>
                                @endif

                                <form method="post" action="" class="shopping-cart-form">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $data->product->id }}" />

                                    @if(count($data->product->variants) > 0)
                                        <div class="wsus__selectbox mb-5">
                                            <div class="row">
                                                @foreach($data->product->variants as $variant)
                                                    @if($variant->status === 1)
                                                        @php $variant->load('items') @endphp
                                                        <div class="col-xl-6 col-sm-6">
                                                            <h5 class="mt-3">{{ $variant->name }}</h5>
                                                            <select class="select_2" name="variant[{{ $variant->id }}]">
                                                                @foreach($variant->items as $item)
                                                                    @if($item->status === 1)
                                                                        <option value="{{ $item->id }}" {{ $item->is_default === 1 ? 'selected="selected"' : '' }}>{{ $item->name }} @if($item->price > 0) (+ {{ $item->price }} {{ $general_settings->currency_name }}) @endif</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($data->product->qty > 0)
                                        <div class="wsus__quentity">
                                            <h5>quantity :</h5>
                                            <div class="select_number">
                                                <input class="number_area" name="qty" type="text" min="1" max="{{ $data->product->qty }}" max="100" value="1" readonly />
                                            </div>
                                        </div>
                                        <ul class="wsus__button_area">
                                            <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                            <li><a class="buy_now" href="#">buy now</a></li>
                                            <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-random"></i></a></li>
                                        </ul>
                                    @endif
                                </form>

                                <p class="brand_model"><span>sku :</span> {{ $data->product->sku }}</p>
                                <p class="brand_model"><span>brand :</span> {{ $data->product->brand->name }}</p>

                                <div class="wsus__pro_det_share">
                                    <h5>share :</h5>
                                    <ul class="d-flex">
                                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
