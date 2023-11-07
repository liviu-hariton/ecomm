<li id="top-cart-row-{{ $item->rowId }}">
    <div class="wsus__cart_img">
        <a href="{{ route('product', $item->options->slug) }}">
            <img src="{{ asset($item->options->image) }}" alt="{{ $item->name }}" class="img-fluid w-100">
        </a>
        <a class="wsis__del_icon remove-from-cart" data-cart-id="{{ $item->rowId }}" href="{{ route('remove-from-cart') }}"><i class="fas fa-minus-circle"></i></a>
    </div>
    <div class="wsus__cart_text">
        <a class="wsus__cart_title" href="{{ route('product', $item->options->slug) }}">{{ $item->qty }} x {{ $item->name }}</a>
        <p>
            @foreach($item->options->variants as $variant_name=>$variant_value)
                <small>{{ $variant_name }}: {{ $variant_value['name'] }} (+ {{ $variant_value['price'] }} <i class="{{ $general_settings->currency_icon }}"></i>)</small><br />
            @endforeach
        </p>
        <p>{{ ($item->price + $item->options->variants_amount) * $item->qty }} <i class="{{ $general_settings->currency_icon }}"></i></p>
    </div>
</li>
