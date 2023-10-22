<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        @foreach($main_menu_categories as $category)
                        <li>
                            <a @if(count($category->children) > 0)class="wsus__droap_arrow" @endif href="{{ $category->slug }}"><i class="{{ $category->icon }}"></i> {{ $category->name }} </a>
                            @if(count($category->children) > 0)
                            <ul class="wsus_menu_cat_droapdown">
                                @foreach($category->children as $child)
                                <li>
                                    <a href="{{ $child->slug }}">{{ $child->name }} @if(count($child->children) > 0)<i class="fas fa-angle-right"></i>@endif</a>

                                    {{-- At this point we could add a recursive Blade component but, for now, let's just manually add one more branch --}}
                                    @if(count($child->children) > 0)
                                    <ul class="wsus__sub_category">
                                        @foreach($child->children as $subchild)
                                        <li><a href="{{ $subchild->slug }}">{{ $subchild->name }}</a> </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="active" href="/">home</a></li>
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a href="contact.html">contact</a></li>

                        @auth()
                            <li><a href="{{ route('user.dashboard') }}">my account</a></li>

                            <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
                            </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">log in</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

        <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li>
    </ul>
    <form>
        <input type="text" placeholder="Search">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        @foreach($main_menu_categories as $category)
                        <li>
                            <a href="{{ $category->slug }}" class="accordion-button collapsed" data-bs-toggle="collapse"
                               data-bs-target="#flush-collapseThreew" aria-expanded="false"
                               aria-controls="flush-collapseThreew"><i class="{{ $category->icon }}"></i> {{ $category->name }}</a>

                            @if(count($category->children) > 0)
                            <div id="flush-collapseThreew" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach($category->children as $child)
                                        <li><a href="{{ $child->slug }}">{{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="/">home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
