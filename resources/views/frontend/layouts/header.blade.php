<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/images/logo_2.png') }}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="wsus__search">
                    <form>
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        <div class="wsus__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="wsus__call_text">
                            <p>example@gmail.com</p>
                            <p>+569875544220</p>
                        </div>
                    </div>
                    <ul class="wsus__icon_area">
                        <li><a href="wishlist.html"><i class="fal fa-heart"></i><span>05</span></a></li>
                        <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li>
                        <li><a class="wsus__cart_icon" href="javascript:void(0)"><i class="fal fa-shopping-bag"></i><span id="cart-count">{{ Cart::content()->count() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="wsus__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul id="sidebar-cart-products">
            @if(Cart::content()->count() > 0)
                @foreach(Cart::content() as $item)
                <x-products.cart-sidebar :item="$item"></x-products.cart-sidebar>
                @endforeach
            @else
                <li>Your cart is empty</li>
            @endif
        </ul>
        @if(Cart::content()->count() > 0)
        <h5>sub total <span id="cart-sidebar-subtotal">{{ cartSubtotal() }}</span> <i class="{{ $general_settings->currency_icon }}"></i></h5>
        <div class="wsus__minicart_btn_area">
            <a class="common_btn" href="{{ route('cart') }}">view cart</a>
            <a class="common_btn" href="{{ route('user.checkout') }}">checkout</a>
        </div>
        @endif
    </div>
</header>
