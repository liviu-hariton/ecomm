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

            <li class="menu-header">Admin</li>
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

            {{--<li class="dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class=active><a class="nav-link" href="#">General Dashboard</a></li>
                    <li><a class="nav-link" href="#">Ecommerce Dashboard</a></li>
                </ul>
            </li>--}}

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-sitemap"></i><span>Content</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.slider.index') }}">Home Slider</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
