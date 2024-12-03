<header class="header">
        <div class="container">
            <div class="header-main">
                <div class="row">
                    <div class="col-md-3 col-100-h">
                        <button type="button" class="trigger-mobile navbar-toggle collapsed visible-sm visible-xs">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo">
                            <a href="/" class="logo-wrapper ">
                                <img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/logo.png?1730193558341" alt="logo DngBike.com" />
                            </a>
                        </div>
                        <div class="mobile-cart visible-sm visible-xs">
                            <a href="{{ route('users.cart.show') }}" title="Cart">
                                <i class="ion ion-md-basket"></i>
                                <span class="cnt crl-bg count_item_pr">1</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="search-header">
                            <div class="header_search search_form">
                                <form class="input-group search-bar search_form" action="/search" method="get" role="search">
                                    <input type="search" name="query" value="" placeholder="Tìm kiếm sản phẩm... " class="input-group-field st-default-search-input search-text" autocomplete="off">
                                    <span class="input-group-btn">
                                        <button class="btn icon-fallback-text">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm hidden-xs">
                        <div class="index-cart cart-wishlist">
                            <ul class="clearfix">
                                <li>
                                    <a href="{{ route('users.cart.show')}}" class="header-cart">
                                        <i class="ion ion-md-basket"></i> Giỏ hàng
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="account-sign">
                            @auth
                                <a href="#" class="account-header">
                                    <i class="ion ion-ios-contact"></i>
                                    <div class="a-text">{{ Auth::user()->name }}<span>{{ Auth::user()->email }}</span></div>
                                </a>
                                <ul>
                                <li>
                                    <form method="GET" action="{{ route('profile.get') }}" class="logout-form">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                Profile
                                            </a>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('auth.logout') }}" class="logout-form">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                Đăng xuất
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a href="/account" class="account-header">
                                    <i class="ion ion-ios-contact"></i>
                                    <div class="a-text">Đăng nhập<span>Tài khoản và đơn hàng</span></div>
                                </a>
                                <ul>
                                    <li><a href="/login">Đăng nhập</a></li>
                                    <li><a href="/register">Đăng ký</a></li>
                                </ul>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('products.components.navigator')
    </header>