<header>
    <div class="header-top hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
                    <div class="header-left">
                        <span>Chào mừng bạn đến với CNM Bike</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 d-list col-xs-12 hidden-xs">
                    <ul class="nav nav-pills nav-justified">
                        @auth
                            <li>
                                <span>{{ Auth::user()->name }}</span>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link">Đăng xuất</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('register') }}">Đăng ký</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>