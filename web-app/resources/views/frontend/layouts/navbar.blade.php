<header>
    <div class="header-top-area">
        <div class="container custom-container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="header-top-left">
                        <ul>
                            <li>Call us: 747-800-9880</li>
                            <li><i class="far fa-clock"></i>Opening Hours: 7:00 am - 9:00 pm (Mon - Sun)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="header-top-right">
                        <ul class="header-top-social">
                            <li class="follow">Follow :</li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="menu-area">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo"><a href="{{ route('home.authenticated') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""></a></div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="{{ request()->routeIs('home.authenticated') ? 'active' : '' }} menu-item-has-children">
                                        <a href="{{ route('home.authenticated') }}">Home</a>
                                        <ul class="submenu">
                                            <li class="{{ request()->routeIs('home.authenticated') ? 'active' : '' }}"><a href="{{ route('home.authenticated') }}">Home One</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->routeIs('about-us') ? 'active' : '' }}"><a href="{{ route('about-us') }}">About Us</a></li>
                                    <li class="menu-item-has-children"><a href="rescue.html">Rescue</a>
                                        <ul class="submenu">
                                        </ul>
                                    </li>
                                    <li><a href="adoption.html">Report</a></li>
                                    <li class="menu-item-has-children"><a href="snakeID.html">SnakeID</a>
                                        <ul class="submenu">
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="blog.html">Blog</a>
                                        <ul class="submenu">
                                        </ul>
                                    </li>
                                    <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contacts</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="header-search"><a href="#"><i class="flaticon-search"></i></a></li>
                                    @auth
                                        <li class="header-btn dropdown">
                                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                {{ Auth::user()->name }} <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @else
                                        <li class="header-btn"><a href="{{ route('signin') }}" class="btn">Login <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a></li>
                                    @endauth
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="mobile-menu">
                        <nav class="menu-box">
                            <div class="close-btn"><i class="fas fa-times"></i></div>
                            <div class="nav-logo"><a href="{{ route('home.authenticated') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" title=""></a></div>
                            <div class="menu-outer">
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu-backdrop"></div>
                </div>
            </div>
            <div class="header-shape" data-background="{{ asset('frontend/img/bg/header_shape.png') }}"></div>
        </div>
        <div class="search-popup-wrap" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="search-close">
                <span><i class="fas fa-times"></i></span>
            </div>
            <div class="search-wrap text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="title">... Search Here ...</h2>
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" name="search" placeholder="Type keywords here">
                                    <button class="search-btn"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>