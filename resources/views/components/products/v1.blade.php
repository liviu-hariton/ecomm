<div class="col-xl-3 col-sm-6 col-lg-4">
    <div class="wsus__product_item">
        @if($data->product->is_top === 1)
        <span class="wsus__new">TOP</span>
        @endif

        @if($data->product->is_best === 1)
        <span class="wsus__new mt-4">BEST</span>
        @endif

        @if($data->product->is_featured === 1)
        <span class="wsus__new mt-5">FEAT</span>
        @endif

        @if(productHasDiscount($data->product) === true)
            <span class="wsus__minus">-{{ computeProductDiscount($data->product) }}%</span>
        @endif

        <a class="wsus__pro_link" href="{{ route('product', $data->product->slug) }}">
            <img src="{{ asset($data->product->image) }}" alt="{{ $data->product->name }}" class="img-fluid w-100 img_1" />
            @if(count($data->product->images) > 0)
                <img src="{{ asset($data->product->images[0]->image) }}" alt="{{ $data->product->images[0]->alt }}" class="img-fluid w-100 img_2" />
            @else
                <img src="{{ asset($data->product->image) }}" alt="{{ $data->product->name }}" class="img-fluid w-100 img_2" />
            @endif
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-eye"></i></a></li>
            <li><a href="#"><i class="far fa-heart"></i></a></li>
            <li><a href="#"><i class="far fa-random"></i></a>
        </ul>
        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $data->product->category->name }} </a>
            <p class="wsus__pro_rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>(133 review)</span>
            </p>

            <a class="wsus__pro_name" href="{{ route('product', $data->product->slug) }}">{{ $data->product->name }}</a>

            <p class="wsus__price">
                ${{ productPrice($data->product) }}

                @if(productHasDiscount($data->product) === true)
                <del>${{ $data->product->price }}</del>
                @endif
            </p>

            <a class="add_cart" href="#">add to cart</a>
        </div>
    </div>
</div>