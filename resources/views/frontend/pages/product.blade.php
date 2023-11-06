@extends('frontend.layouts.master')

@section('main-content')
    <section id="wsus__product_details">
        <div class="container">
            @if(auth()->user() && (auth()->user()->role === 'admin' || (auth()->user()->vendor && auth()->user()->vendor->id === $product->vendor_id)))
            <div class="card mb-2">
                <div class="card-header">
                    <i class="fa fa-user-cog"></i> Product Options
                </div>
                <div class="card-body">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route(userRole().'.product.edit', $product) }}" class="btn btn-success" target="_blank"><i class="fa fa-pencil-alt"></i> Edit</a>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-cogs"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route(userRole().'.image-gallery.index', ['pid' => $product->id]) }}" target="_blank"><i class="fa fa-images"></i> Image gallery</a></li>
                                <li><a class="dropdown-item" href="{{ route(userRole().'.variant.index', ['pid' => $product->id]) }}" target="_blank"><i class="fa fa-th-list"></i> Variants</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group btn-group-sm ms-5">
                        <input type="checkbox" class="btn-check change-attribute" id="is_top" data-id="{{ $product->id }}" data-attribute="is_top" data-model="App^Models^Product" {{ $product->is_top ? 'checked="checked"' : '' }}>
                        <label class="btn btn-outline-primary" for="is_top">Top</label>

                        <input type="checkbox" class="btn-check change-attribute" id="is_best" data-id="{{ $product->id }}" data-attribute="is_best" data-model="App^Models^Product" {{ $product->is_best ? 'checked="checked"' : '' }}>
                        <label class="btn btn-outline-primary" for="is_best">Best</label>

                        <input type="checkbox" class="btn-check change-attribute" id="is_featured" data-id="{{ $product->id }}" data-attribute="is_featured" data-model="App^Models^Product" {{ $product->is_featured ? 'checked="checked"' : '' }}>
                        <label class="btn btn-outline-primary" for="is_featured">Featured</label>
                    </div>

                    <div class="btn-group btn-group-sm ms-5">
                        <input type="checkbox" class="btn-check change-status" id="status" data-id="{{ $product->id }}" data-model="App^Models^Product" {{ $product->status ? 'checked="checked"' : '' }}>
                        <label class="btn btn-outline-warning" for="status">Active</label>

                        @if(auth()->user()->role === 'admin')
                        <input type="checkbox" class="btn-check change-approved" id="approved" data-id="{{ $product->id }}" data-model="App^Models^Product" {{ $product->approved ? 'checked="checked"' : '' }}>
                        <label class="btn btn-outline-warning" for="approved">Approved</label>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5 z999">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if($product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video" href="{{ $product->video_link }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    @endif

                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->image) }}" alt="{{ $product->name }}"></li>

                                        @if(count($product->images) > 0)
                                        @foreach($product->images as $image)
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($image->image) }}" alt="{{ $image->alt }}"></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @if(count($product->images) > 0)
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i> </a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="{{ route('product', $product) }}">{{ $product->name }}</a>

                            <p class="wsus__stock_area">
                                @if($product->qty > 0)
                                <span class="in_stock">in stock</span>
                                @endif

                                ({{ $product->qty }} items)
                            </p>

                            <h4>
                                {{ productPrice($product) }} <i class="{{ $general_settings->currency_icon }}"></i>

                                @if(productHasDiscount($product) === true)
                                    <del>{{ $product->price }} <i class="{{ $general_settings->currency_icon }}"></i></del>
                                @endif
                            </h4>

                            @if(productHasDiscount($product) === true)
                            <div class="wsus_pro_hot_deals">
                                <h5>offer active until : </h5>
                                <div class="simply-countdown product-offer-countdown"></div>
                            </div>
                            @endif

                            <p class="review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>20 review</span>
                            </p>

                            <div class="description">
                                {!! $product->short_description !!}
                            </div>

                            <form method="post" action="" class="shopping-cart-form">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                @if(count($product->variants) > 0)
                                <div class="wsus__selectbox mb-5">
                                    <div class="row">
                                        @foreach($product->variants as $variant)
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
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <div class="wsus__quentity">
                                    <h5>quantity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="qty" type="text" min="1" max="100" value="1" />
                                    </div>
                                </div>

                                <ul class="wsus__button_area mb-5">
                                    <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                    <li><a class="buy_now" href="#">buy now</a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a></li>
                                </ul>
                            </form>

                            <p class="brand_model"><span>sku :</span> {{ $product->sku }}</p>
                            <p class="brand_model"><span>brand :</span> <a href="#">{{ $product->brand->name }}</a></p>

                            <a class="wsus__pro_report mt-3" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fal fa-comment-alt-smile"></i> Report incorrect product information.</a>

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
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Return Available</h4>
                                        <p>Lorem Ipsum is simply dummy</p>
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                        <p>Lorem Ipsum is simply dummy</p>
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Warranty Available</h4>
                                        <p>Lorem Ipsum is simply dummy</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="wsus__det_sidebar_banner">
                                <img src="{{ asset('frontend/images/blog_1.jpg') }}" alt="banner" class="img-fluid w-100">
                                <div class="wsus__det_sidebar_banner_text_overlay">
                                    <div class="wsus__det_sidebar_banner_text">
                                        <p>Black Friday Sale</p>
                                        <h4>Up To 70% Off</h4>
                                        <a href="#" class="common_btn">shope now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                            data-bs-target="#pills-home22" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-contact" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                            data-bs-target="#pills-contact2" type="button" role="tab"
                                            aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                     aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                {!! $product->long_description !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>1</span> Free Shipping & Return</h6>
                                                    <p>We offer free shipping for products on orders above 50$ and
                                                        offer
                                                        free delivery for all orders in US.</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>2</span> Free and Easy Returns</h6>
                                                    <p>We guarantee our products and you could get back all of your
                                                        money anytime you want in 30 days.</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>3</span> Special Financing </h6>
                                                    <p>Get 20%-50% off items over 50$ for a month or over 250$ for a
                                                        year with our special credit card.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                     aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset($product->vendor->banner) }}" alt="{{ $product->vendor->shop_name }}" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-7 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->shop_name }}</h4>
                                                    <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(41 review)</span>
                                                    </p>
                                                    <p><span>Vendor Name:</span> {{ $product->vendor->user->name }}</p>
                                                    <p><span>Address:</span> {{ $product->vendor->address }}</p>
                                                    <p><span>Phone:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>mail:</span> {{ $product->vendor->email }}</p>

                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="wsus__vendor_details">
                                                    {!! $product->vendor->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                     aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>02</span></h4>
                                                        <div class="wsus__main_comment">
                                                            <div class="wsus__comment_img">
                                                                <img src="{{ asset('frontend/images/client_img_3.jpg') }}" alt="user"
                                                                     class="img-fluid w-100">
                                                            </div>
                                                            <div class="wsus__comment_text reply">
                                                                <h6>Shopnil mahadi <span>4 <i
                                                                            class="fas fa-star"></i></span></h6>
                                                                <span>09 Jul 2021</span>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit.
                                                                    Cupiditate sint molestiae eos? Officia, fuga eaque.
                                                                </p>
                                                                <ul class="">
                                                                    <li><img src="{{ asset('frontend/images/headphone_1.jpg') }}" alt="product"
                                                                             class="img-fluid w-100"></li>
                                                                    <li><img src="{{ asset('frontend/images/headphone_2.jpg') }}" alt="product"
                                                                             class="img-fluid w-100"></li>
                                                                    <li><img src="{{ asset('frontend/images/kids_1.jpg') }}" alt="product"
                                                                             class="img-fluid w-100"></li>
                                                                </ul>
                                                                <a href="#" data-bs-toggle="collapse"
                                                                   data-bs-target="#flush-collapsetwo">reply</a>
                                                                <div class="accordion accordion-flush"
                                                                     id="accordionFlushExample2">
                                                                    <div class="accordion-item">
                                                                        <div id="flush-collapsetwo"
                                                                             class="accordion-collapse collapse"
                                                                             aria-labelledby="flush-collapsetwo"
                                                                             data-bs-parent="#accordionFlushExample">
                                                                            <div class="accordion-body">
                                                                                <form>
                                                                                    <div
                                                                                        class="wsus__riv_edit_single text_area">
                                                                                        <i class="far fa-edit"></i>
                                                                                        <textarea cols="3" rows="1"
                                                                                                  placeholder="Your Text"></textarea>
                                                                                    </div>
                                                                                    <button type="submit"
                                                                                            class="common_btn">submit</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="wsus__main_comment">
                                                            <div class="wsus__comment_img">
                                                                <img src="{{ asset('frontend/images/client_img_1.jpg') }}" alt="user"
                                                                     class="img-fluid w-100">
                                                            </div>
                                                            <div class="wsus__comment_text reply">
                                                                <h6>Smith jhon <span>5 <i
                                                                            class="fas fa-star"></i></span>
                                                                </h6>
                                                                <span>09 Jul 2021</span>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit.
                                                                    Cupiditate sint molestiae eos? Officia, fuga eaque.
                                                                </p>
                                                                <a href="#" data-bs-toggle="collapse"
                                                                   data-bs-target="#flush-collapsetwo2">reply</a>
                                                                <div class="accordion accordion-flush"
                                                                     id="accordionFlushExample2">
                                                                    <div class="accordion-item">
                                                                        <div id="flush-collapsetwo2"
                                                                             class="accordion-collapse collapse"
                                                                             aria-labelledby="flush-collapsetwo"
                                                                             data-bs-parent="#accordionFlushExample">
                                                                            <div class="accordion-body">
                                                                                <form>
                                                                                    <div
                                                                                        class="wsus__riv_edit_single text_area">
                                                                                        <i class="far fa-edit"></i>
                                                                                        <textarea cols="3" rows="1"
                                                                                                  placeholder="Your Text"></textarea>
                                                                                    </div>
                                                                                    <button type="submit"
                                                                                            class="common_btn">submit</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="pagination">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination">
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="#"
                                                                           aria-label="Previous">
                                                                            <i class="fas fa-chevron-left"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="page-item"><a
                                                                            class="page-link page_active" href="#">1</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                                             href="#">2</a></li>
                                                                    <li class="page-item"><a class="page-link"
                                                                                             href="#">3</a></li>
                                                                    <li class="page-item"><a class="page-link"
                                                                                             href="#">4</a></li>
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="#" aria-label="Next">
                                                                            <i class="fas fa-chevron-right"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                        <h4>write a Review</h4>
                                                        <form action="#">
                                                            <p class="rating">
                                                                <span>select your rating : </span>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="wsus__single_com">
                                                                        <input type="text" placeholder="Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="wsus__single_com">
                                                                        <input type="email" placeholder="Email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="col-xl-12">
                                                                        <div class="wsus__single_com">
                                                                            <textarea cols="3" rows="3"
                                                                                      placeholder="Write your review"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="img_upload">
                                                                <div class="gallery">
                                                                    <a class="cam" href="javascript:void(0)"><span><i
                                                                                class="fas fa-image"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="wsus__flash_sell">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>Related Products</h3>
                        <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend/images/pro3.jpg') }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend/images/pro3_3.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">Electronics </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">hp 24" FHD monitore</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend/images/pro4.jpg') }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend/images/pro4_4.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend/images/pro9.jpg') }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend/images/pro9_9.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(120 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's fashion sholder bag</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend/images/pro2.jpg') }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend/images/pro2_2.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(72 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual shoes</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="{{ asset('frontend/images/pro4.jpg') }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ asset('frontend/images/pro4_4.jpg') }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown('.product-offer-countdown', {
                year: {{ date('Y', strtotime($product->offer_end_date)) }},
                month: {{ date('m', strtotime($product->offer_end_date)) }},
                day: {{ date('d', strtotime($product->offer_end_date)) }},
                hours: {{ date('H', strtotime($product->offer_end_date)) }},
                minutes: {{ date('i', strtotime($product->offer_end_date)) }}
            });
        });

        @if(auth()->user() && (auth()->user()->role === 'admin' || (auth()->user()->vendor && auth()->user()->vendor->id === $product->vendor_id)))
        $('body').on('click', '.change-status', function(e) {
            let _status = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route(userRole().'.change-status') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status" : _status,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });

        $('body').on('click', '.change-approved', function(e) {
            let _approved = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.change-approved') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "approved" : _approved,
                    "id": _id,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });

        $('body').on('click', '.change-attribute', function(e) {
            let _enabled = $(this).is(':checked') === true ? '1' : '0';
            let _id = $(this).data('id');
            let _attribute = $(this).data('attribute');
            let _model = $(this).data('model');

            $.ajax({
                type: 'PUT',
                url: '{{ route(userRole().'.change-attribute') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "enabled" : _enabled,
                    "id": _id,
                    "attribute": _attribute,
                    "model": _model
                },
                success: function(data) {
                    if(data.status === 'success') {
                        toastr.success(data.message);
                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });
        @endif
    </script>
@endpush
