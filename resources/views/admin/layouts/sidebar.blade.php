<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Frontend</li>
            <li><a class="nav-link" href="/" target="_blank"><i class="fa fa-globe"></i> <span>Home</span></a></li>

            <li class="menu-header">Admin</li>
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

            {{--<li class="dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class=active><a class="nav-link" href="#">General Dashboard</a></li>
                    <li><a class="nav-link" href="#">Ecommerce Dashboard</a></li>
                </ul>
            </li>--}}

            <li class="dropdown {{ menuItemActive(['admin.category.*', 'admin.brand.*', 'admin.product.*', 'admin.image-gallery.*', 'admin.variant.*', 'admin.product-variant-item.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-sitemap"></i><span>Catalogue</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menuItemActive(['admin.category.*']) }}"><a class="nav-link" href="{{ route('admin.category.index') }}">Categories</a></li>
                    <li class="{{ menuItemActive(['admin.brand.*']) }}"><a class="nav-link" href="{{ route('admin.brand.index') }}">Brands</a></li>
                    <li class="{{ menuItemActive(['admin.product.*', 'admin.image-gallery.*', 'admin.variant.*', 'admin.product-variant-item.*']) }}"><a class="nav-link" href="{{ route('admin.product.index') }}">Products</a></li>
                </ul>
            </li>

            <li class="dropdown {{ menuItemActive(['admin.vendor-profile.*', 'admin.vendor.*', 'admin.flash-sale.*', 'admin.coupons.*', 'admin.shipping-rules.*', 'admin.payment-settings.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-store-alt"></i><span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menuItemActive(['admin.vendor.*']) }}"><a class="nav-link" href="{{ route('admin.vendor.index') }}">Vendors</a></li>
                    <li class="{{ menuItemActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">My Vendor Profile</a></li>
                    <li class="{{ menuItemActive(['admin.flash-sale.*']) }}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}">Flash sale</a></li>
                    <li class="{{ menuItemActive(['admin.coupons.*']) }}"><a class="nav-link" href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                    <li class="{{ menuItemActive(['admin.shipping-rules.*']) }}"><a class="nav-link" href="{{ route('admin.shipping-rules.index') }}">Shipping rules</a></li>
                    <li class="{{ menuItemActive(['admin.payment-settings.*']) }}"><a class="nav-link" href="{{ route('admin.payment-settings.index') }}">Payment</a></li>
                </ul>
            </li>

            <li class="dropdown {{ menuItemActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i><span>Content</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ menuItemActive(['admin.category.index']) }}"><a class="nav-link" href="{{ route('admin.slider.index') }}">Home Slider</a></li>
                </ul>
            </li>

            <li class="{{ menuItemActive(['admin.settings.*']) }}"><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
        </ul>
    </aside>
</div>
