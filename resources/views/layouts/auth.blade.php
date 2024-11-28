<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.1.1/dist/css/ionicons.min.css">

    <!-- Main CSS -->
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/base.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/ant-sport.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-main">
                <div class="row">
                    <div class="col-md-3 col-100-h">
                        <div class="logo">
                            <a href="/" class="logo-wrapper">
                                <img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/logo.png?1730193558341" alt="logo" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">
                        <li class="home">
                            <a href="/" title="Trang chủ"><span>Trang chủ</span></a>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        <li><strong><span>@yield('title')</span></strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="site-footer">
            <div class="container">
                <div class="footer-inner padding-top-30 padding-bottom-20">
                    <div class="row">
                        <!-- Footer content from show.blade.php -->
                        @include('general.components.footer')
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright clearfix">
            <div class="container">
                <div class="inner clearfix">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span>© Bản quyền thuộc về <b>DNGBIKE</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Additional Scripts -->
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/option-selectors.js?1730193558341"></script>
    <script src="//bizweb.dktcdn.net/assets/themes_support/api.jquery.js"></script>
</body>
</html> 