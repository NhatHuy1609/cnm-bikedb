<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ $product->name }}
    </title>

    <!-- Bootstrap 3.3.7 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.1.1/dist/css/ionicons.min.css">

    <!-- Build Main CSS -->
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/base.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/ant-sport.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <style>
        .carousel-inner > .item > img {
            width: 100%;
            height: auto;
        }

        .carousel-indicators {
            bottom: 0;
        }

        .carousel-control {
            background: none;
        }

        .thumbnail-product .item {
            cursor: pointer;
        }

        .thumbnail-product .item img {
            max-width: 100%;
            height: auto;
        }

        .tab-content {
            display: none;
        }

        .tab-content.current {
            display: block;
        }

        .tabs-title li {
            cursor: pointer;
            position: relative;
            text-decoration: none;
            border-bottom: none;
        }

        .tabs-title li h3 {
            text-decoration: none;
            border-bottom: none;
        }

        .tabs-title li.current {
            color: #fff;
            text-decoration: none;
            border-bottom: none;
        }

        .tabs-title li::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .tabs-title li:hover::after {
            width: 100%;
        }

        .tabs-title li.current::after {
            width: 100%;
        }

        .sticky-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .main-navigation {
            width: 100%;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Main content -->
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
                            <a href="{{ route('users.cart.show', 1) }}" title="Cart">
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
                                    <a href="{{ route('users.cart.show', 1) }}" class="header-cart">
									<i class="ion ion-md-basket"></i> Giỏ hàng <span class="cart-wishlist-number cartCount">1</span>
								</a>
                                </li>
                            </ul>
                        </div>
                        <div class="account-sign">
                            <a href="/account" class="account-header">
							<i class="ion ion-ios-contact"></i>
							<div class="a-text">Đăng nhập<span>Tài khoản và đơn hàng</span></div>
						</a>
                            <ul>

                                <li><a href="/account/login">Đăng nhập</a></li>
                                <li><a href="/account/register">Đăng ký</a></li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navigation">
            <nav class="hidden-sm hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="nav" class="nav">
                                <li class="nav-item ">
                                    <a href="/xe-dap-all-onebike" class="nav-link">THƯƠNG HIỆU <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-trek">XE ĐẠP TREK - USA</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-giant">XE ĐẠP GIANT - TAIWAN</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-liv-nu">XE ĐẠP LIV - TAIWAN</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-twitter-1">XE ĐẠP TWITTER</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-the-thao-khac">XE ĐẠP HÃNG KHÁC</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="/xe-dap-all-onebike" class="nav-link">XE ĐẠP <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-khuyen-mai">XE ĐẠP KHUYẾN MÃI GIẢM ĐẾN 30%</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-dua-road-1">XE ĐẠP ĐUA - ROAD</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-dia-hinh-mtb-1">XE ĐẠP ĐỊA HÌNH - MTB</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-duong-pho-1">XE ĐẠP ĐƯỜNG PHỐ</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-duong-truong-touring">XE ĐẠP ĐƯỜNG TRƯỜNG</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-the-thao-nu">XE ĐẠP NỮ</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-hoc-sinh-1">XE ĐẠP HỌC SINH</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-tro-luc-dien">XE ĐẠP TRỢ LỰC ĐIỆN</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="/xe-dap-dien" class="nav-link">XE ĐIỆN <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/xe-dap-dien">XE ĐẠP ĐIỆN - XE MÁY ĐIỆN</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/">PHỤ TÙNG XE ĐIỆN</a>
                                        </li>
                                        <li class="nav-item-lv2">
                                            <a class="nav-link" href="/">PHỤ KIỆN XE ĐIỆN</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="/phu-tung-xe-dap" class="nav-link">PHỤ TÙNG <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/khung-phuoc-chen-co">KHUNG - PHUỘC - CHÉN CỔ <i class="fa fa-angle-right"></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/khung-suon-xe-dap">KHUNG SƯỜN</a>
                                                </li>
                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/phuoc-xe-dap-1">PHUỘC</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/chen-co-xe-dap-1">CHÉN CỔ</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/ghi-dong-po-tang">GHI ĐÔNG - PÔ TĂNG <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/ghi-dong-xe-dap-1">GHI ĐÔNG</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/po-tang-xe-dap-1">PÔ TĂNG</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/tay-de-tay-phanh">TAY ĐỀ & TAY PHANH <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/tay-de-xe-dap-1">TAY ĐỀ</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/tay-phanh-xe-dap">TAY PHANH</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/day-de-day-phanh-xe-dap">DÂY ĐỀ & DÂY PHANH</a>
                                                </li>

                                            </ul>
                                        </li>



                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/bo-phanh-gon-phanh">BỘ PHANH & GÔN PHANH <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/bo-phanh-xe-dap">BỘ PHANH</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/ma-phanh-xe-dap">MÁ PHANH</a>
                                                </li>

                                            </ul>
                                        </li>



                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/truc-dui-dia">GIÒ DĨA & TRỤC GIỮA <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/gio-dia-xe-dap">GIÒ DĨA XE ĐẠP</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/truc-giua-xe-dap">TRỤC GIỮA XE ĐẠP</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/can-giay-xe-dap">PEDAL & CAN XE ĐẠP <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/pedal-xe-dap">PEDAL</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/can-giay-xe-dap">CAN GIÀY</a>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item ">
                                    <a href="/phu-kien-xe-dap" class="nav-link">PHỤ KIỆN <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/pk-khuyen-mai">PHỤ KIỆN KHUYẾN MÃI - GIẢM ĐẾN 50% <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/phu-kien-khuyen-mai">PHỤ KIỆN KHUYẾN MÃI</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/gong-binh-nuoc-xe-dap-2">GỌNG & BÌNH NƯỚC <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/gong-binh-nuoc-xe-dap-1">GỌNG BÌNH NƯỚC</a>
                                                </li>

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/binh-nuoc-xe-dap-1">BÌNH NƯỚC</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu nav-item-lv2">
                                            <a class="nav-link" href="/phu-kien-fixed-gear">PHỤ KIỆN FIXED GEAR <i class="fa fa-angle-right"></i></a>

                                            <ul class="dropdown-menu">

                                                <li class="nav-item-lv3">
                                                    <a class="nav-link" href="/phu-kien-fixed-gear">PHỤ KIỆN FIXED GEAR</a>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item  has-mega">
                                    <a href="/" class="nav-link">GIỚI THIỆU <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>

                                    <div class="mega-content">
                                        <div class="level0-wrapper2">
                                            <div class="nav-block nav-block-center">
                                                <ul class="level0">


                                                    <li class="level1 parent item">
                                                        <h2 class="h4">
                                                            <a href="/gioi-thieu-cong-ty-tnhh-dngbike">
							<span>VỀ CHÚNG TÔI</span>
						</a>
                                                        </h2>
                                                        <ul class="level1">
                                                            <li class="level2"> <a href="/gioi-thieu-cong-ty-tnhh-dngbike"><span>Giới thiệu công ty DNGBIKE</span></a> </li>
                                                            <li class="level2"> <a href="/gioi-thieu-ve-team-dngbike"><span>Hoạt động Team DNGBIKE</span></a> </li>
                                                            <li class="level2"> <a href="/doi-tac"><span>Đối tác thương hiệu</span></a> </li>
                                                            <li class="level2"> <a href="/tuyen-dung"><span>Tuyển dụng nhân sự</span></a> </li>
                                                            <li class="level2"> <a href="/danh-gia-cua-khach-hang-ve-dngbike"><span>Đánh giá của khách hàng</span></a> </li>
                                                            <li class="level2"> <a href="/xe-dap-the-thao-dngbike"><span>Tìm cửa hàng</span></a> </li>
                                                            <li class="level2"> <a href="/gioi-thieu-ve-team-dngbike"><span>Tin tức & các hoạt động</span></a> </li>
                                                            <li class="level2 seemore">
                                                                <a href="/gioi-thieu-cong-ty-tnhh-dngbike"><span>Xem tất cả</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="level1 parent item">
                                                        <h2 class="h4">
                                                            <a href="/blog-xe-dap">
							<span>CHÍNH SÁCH</span>
						</a>
                                                        </h2>
                                                        <ul class="level1">
                                                            <li class="level2"> <a href="/bao-hanh"><span>Bảo hành bảo dưỡng</span></a> </li>
                                                            <li class="level2"> <a href="/quy-dinh-doi-tra"><span>Đổi trả hàng hóa</span></a> </li>
                                                            <li class="level2"> <a href="/tra-gop-lai-suat-0"><span>Mua hàng trả góp</span></a> </li>
                                                            <li class="level2"> <a href="/dieu-khoan-va-bao-mat"><span>Chính sách bảo mật thông tin</span></a> </li>
                                                            <li class="level2"> <a href="/chinh-sach-giao-nhan-xe-dap"><span>Giao hàng lắp đặt</span></a> </li>
                                                            <li class="level2"> <a href="/the-thanh-vien"><span>Thành viên thân thiết</span></a> </li>
                                                            <li class="level2"> <a href="/mua-xe-dap-ngay-nhan-qua-lien-tay"><span>Đại lý phân phối</span></a> </li>
                                                            <li class="level2"> <a href="/mua-xe-dap-ngay-nhan-qua-lien-tay"><span>Hợp tác bán hàng CTV & AFF</span></a> </li>
                                                            <li class="level2 seemore">
                                                                <a href="/blog-xe-dap"><span>Xem tất cả</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb">					
					<li class="home ">
						<a  href="/ " title="Trang chủ "><span >Trang chủ</span></a>						
						<span><i class="fa fa-angle-right "></i></span>
					</li>
					<li>
						<a  href="/xe-dap-dua-road-1 " title="XE ĐẠP ĐUA - ROAD "><span >XE ĐẠP ĐUA - ROAD</span></a>						
						<span><i class="fa fa-angle-right "></i></span>
					</li>
					<li ><strong><span >{{ $product->name }}</span></strong><li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="product " itemscope itemtype="http://schema.org/Product ">	
	<div class="container ">
		<div class="row ">
			<div class="col-lg-12 details-product ">
				<div class="row product-bottom ">
					<div class="col-lg-12 ">
						<div class="border-bg clearfix padding-bottom-10 padding-top-10 ">
							<div class="col-xs-12 col-sm-6 col-lg-5 col-md-6 ">
								<div class="relative product-image-block ">
                                <div class="large-image">
                                    <!-- Main image slider -->
                                    <div id="productImageSlider" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @foreach($product->productImages as $index => $image)
                                                <li data-target="#productImageSlider" 
                                                    data-slide-to="{{ $index }}" 
                                                    class="{{ $index === 0 ? 'active' : '' }}">
                                                </li>
                                            @endforeach
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            @forelse($product->productImages as $index => $image)
                                                <div class="item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ $image->link }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-responsive center-block">
                                                </div>
                                            @empty
                                                <div class="item active">
                                                    <img src="https://img.freepik.com/free-vector/404-error-with-landscape-concept-illustration_114360-7898.jpg" 
                                                         alt="Default Image" 
                                                         class="img-responsive center-block">
                                                </div>
                                            @endforelse
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#productImageSlider" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#productImageSlider" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                </div>	
								</div>
								<div class="social-sharing margin-top-20 ">
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<script type="text/javascript " src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a099baca270babc "></script>
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<div class="addthis_inline_share_toolbox_uu9r "></div>
								</div>
								
							</div>
							<div class="col-xs-12 col-sm-6 col-lg-7 col-md-6 details-pro ">
								<h1 class="title-head bk-product-name ">{{ $product->name }}</h1>
								<div class="panel-product-line panel-product-rating clearfix ">
									<div class="sapo-product-reviews-badge sapo-product-reviews-badge-detail " data-id="36568086 "></div>
									<div class="iddanhgia " onclick="scrollToxx(); ">
										<span>Viết đánh giá</span>
									</div>
								</div>
								<div class="divider-full-1 "></div>
								<div class="inventory_quantity d-inline-block">
									<span class="stock-brand-title"><strong>Tình trạng:</strong></span>
									@if($product->quantity > 0)
										<span class="a-stock">Còn hàng ({{$product->quantity}})</span>
									@else
										<span class="a-stock a-stock-out">Hết hàng (0)</span>
									@endif
								</div>
								<div class="price-box " itemprop="offers " itemscope itemtype="http://schema.org/Offer ">
									<link itemprop="availability " href="http://schema.org/InStock ">
									<meta itemprop="priceCurrency " content="VND ">
									<meta itemprop="price " content="2490000 ">
									<meta itemprop="url " content="https://dngbike.com/xe-dap-dua-youma-3-7 ">
									<meta itemprop="priceValidUntil " content="2099-01-01 ">
									<span class="special-price ">
										<span class="price product-price bk-product-price ">Giá: {{ $product->price }}₫</span>
									</span> <!-- Giá Khuyến mại -->
									<span class="old-price "><del class="price product-price-old "></del>
									</span> <!-- Giá gốca -->
								</div>
								<div class="product-summary product_description margin-bottom-15 ">
									<div class="rte description ">
										<p>
<style type="text/css ">
</style>
<span style="color:#e74c3c; "><strong>CAM KẾT GIÁ RẺ NHẤT THỊ TRƯỜNG</strong></span><br />
** Ở đâu giá rẻ, liên hệ Onebike.vn để được giảm rẻ hơn!<br />
** Tặng bộ phụ kiện trị giá 100.000đ khi checkin<br />
** Bảo hành chính hãng - 1 Đổi 1 trong vòng 30 ngày<br />
** Xe chính hãng - Dịch vụ tốt - Chốt Onebike.vn / Dngbike.com </p>
										
									</div>
								</div>
								
								<div class="form-product ">
									<form enctype="multipart/form-data" id="add-to-cart-form " action="" method="post " class="form-inline ">
										<div class="form-group ">
											<div class="custom custom-btn-number form-control ">									
												<label>Số lượng</label>
												<button onclick="var result=document.getElementById( 'qty'); var qty=result.value; if( !isNaN(qty) & qty> 1 ) result.value--;return false;" class="btn-minus btn-cts" type="button">–</button>
                        <input type="text" class="qty bk-product-qty input-text" id="qty" name="quantity" size="4" value="1" />
                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" class="btn-plus btn-cts" type="button">+</button>
                </div>
                <div class="clearfix margin-bottom-20"></div>
                <div class="clearfix">
                <button 
                            class="btn btn-lg btn-gray btn-cart" 
                            onclick="addToCart('{{ 1 }}', '{{ $product->id }}', document.getElementById('qty').value)">
                            <span class="txt-main">THÊM VÀO GIỎ HÀNG</span>
                            <span class="txt-sub">Giao hàng tận nơi</span>
                        </button>
                    <button type="submit" class="btn btn-lg btn-gray btn-cart">
                            <span class="txt-main">TƯ VẤN SẢN PHẨM</span>
                            <span class="txt-sub">Gọi ngay</span>
                        </button>


                </div>
            </div>
            <div class="ab-available-notice-button ab-hide" data-ab-product-id="36568086">
                <button class="ab-notice-btn" title="" type="button" onclick="ABAvailableNotice.noticeButtonClick()">
		BÁO KHI CÓ HÀNG
	</button>
            </div>
            </form>
        </div>
        </div>
        </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-9">
                <div class="border-bg clearfix">
                    <div class="col-xs-12 col-lg-12">
                        <!-- Nav tabs -->
                        <div class="product-tab e-tabs padding-bottom-10">
                            <ul class="tabs tabs-title clearfix">
                                <li class="tab-link" data-tab="tab-1">
                                    <h3><span>Mô tả sản phẩm</span></h3>
                                </li>
                                <li class="tab-link" data-tab="tab-2">
                                    <h3><span>Bảo hành Đổi trả</span></h3>
                                </li>
                                <li class="tab-link" data-tab="tab-3">
                                    <h3><span>Đánh giá</span></h3>
                                </li>
                            </ul>
                            <div id="tab-1" class="tab-content">
                                <h2 style="text-align: center;"><strong><span style="font-size:20px;">MÔ TẢ SẢN PHẨM&nbsp;TẠI DNGBIKE</span></strong></h2>
                                <div class="rte">
                                    <p style="text-align: justify;">
                                        <span style="font-size:16px;">{{ $product->description }}&nbsp;</span>
                                    </p>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-content">
                                <h2 style="text-align: center;"><strong><span style="font-size:20px;">CHÍNH SÁCH BẢO HÀNH&nbsp;TẠI DNGBIKE</span></strong></h2>
                                <h3><span style="font-size:18px;"><strong>I.&nbsp;NỘI DUNG&nbsp;BẢO HÀNH</strong></span></h3>
                                <h4 style="text-align: justify;"><span style="font-size:16px;"><strong>1.1. Thời gian&nbsp;bảo hành</strong></span></h4>
                                <p style="text-align: justify;"><span style="font-size:16px;">- Thời gian bảo hành tùy thuộc vào chế độ bảo hành của từng&nbsp;loại xe và từng nhà sản xuất. Cửa hàng sẽ áp dụng theo quy định của nhà sản xuất.</span></p>
                                <h4 style="text-align: justify;"><span style="font-size:16px;"><strong>1.2. Điều kiện&nbsp;bảo hành</strong></span></h4>
                                <p style="text-align: justify;"><span style="font-size:16px;">- Sản phẩm bảo hành&nbsp;trong thời gian bảo hành phải còn nguyên vẹn,&nbsp;không có dấu hiệu cạy, mở, hay tháo rời,&nbsp;chưa qua sửa chữa<br />
- Lỗi&nbsp;được đội ngũ kỹ thuật của&nbsp;DNGBIKE&nbsp;xác định là&nbsp;do lỗi kỹ thuật sản phẩm&nbsp;hoặc do lỗi của nhà sản xuất.</span></p>
                                <h4 style="text-align: justify;"><strong><span style="font-size:16px;">1.3. Thủ tục bảo hành</span></strong></h4>
                                <p style="text-align: justify;"><span style="font-size:16px;">- Đối với sản phẩm là&nbsp;xe đạp: Khách hàng mang sản phẩm cần bảo hành kèm&nbsp;theo sổ bảo hành chính hãng do công ty phát hành&nbsp;khi bán hàng, nếu khách hàng không có sổ bảo hành do công ty DNGBIKE phát hành thì khách hàng cần&nbsp;xuất trình được thông tin sản phẩm và thông tin&nbsp;người mua hàng trùng khớp với thông tin lưu trữ&nbsp;trên hệ thống lưu trữ của công ty.</span></p>
                                <p style="text-align: justify;"><span style="font-size:16px;">-&nbsp;Đối với sản phẩm là&nbsp;phụ tùng phụ kiện: Khách hàng mang sản phẩm cần bảo hành kèm&nbsp;theo hóa đơn mua hàng, nếu khách hàng không có hóa đơn mua hàng&nbsp;thì khách hàng cần&nbsp;xuất trình được thông tin sản phẩm và thông tin&nbsp;người mua hàng trùng khớp với thông tin lưu trữ&nbsp;trên hệ thống lưu trữ của công ty.</span></p>
                                <h4 style="text-align: justify;"><strong><span style="font-size:16px;">1.4. Các trường hợp không được bảo hành miễn phí</span></strong></h4>
                                <div style="text-align: justify;"><span style="font-size:16px;">- Lỗi được xác định là&nbsp;do từ phía&nbsp;khách hàng: Sản phẩm&nbsp;hư hỏng do tai nạn, va chạm, bóp méo, biến dạng,&nbsp;trầy sước sơn, rỉ két,&nbsp;do tháo lắp không đúng cách,&nbsp;không đọc kỹ hướng dẫn sử dụng trước khi dùng,&nbsp;tự ý tháo lắp và thay đổi&nbsp;các thành phần đã được nhà sản xuất cài đặt sẵn</span></div>
                                <div style="text-align: justify;"><span style="font-size:16px;">- Hư hỏng do thiên tai, hỏa hoạn&nbsp;hoặc do vận chuyển không đúng quy cách.&nbsp;</span></div>
                                <div style="text-align: justify;"><span style="font-size:16px;">- Trường hợp xe xuống cấp do thiếu bảo trì tốt.&nbsp;&nbsp;</span></div>
                                <div>
                                    <div style="text-align: justify;"><span style="font-size:16px;">- Sử dụng xe không đúng cách, không đúng mục đích...</span></div>
                                    <div style="text-align: justify;"><span style="font-size:16px;">-&nbsp;Vui lòng không tự ý tháo ráp, sửa chửa trước khi đem đến bảo hành.&nbsp;&nbsp;</span></div>
                                    <div style="text-align: center;"><strong><span style="color:#e74c3c;"><em><span style="font-size:16px;">Xin quý khách vui lòng không nhầm lẫn việc bảo hành với bảo hiểm hay bảo trì.&nbsp;</span></em></span></strong></div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-content">
                                <div id="sapo-product-reviews" class="sapo-product-reviews" data-id="36568086">
                                    <div id="sapo-product-reviews-noitem" style="display: none;">
                                        <div class="content">
                                            <p data-content-text="language.suggest_noitem"></p>
                                            <div class="product-reviews-summary-actions">
                                                <button type="button" class="btn-new-review" onclick="BPR.newReview(this); return false;" data-content-str="language.newreview"></button>
                                            </div>
                                            <div id="noitem-bpr-form_" data-id="formId" class="noitem-bpr-form" style="display:none;">
                                                <div class="sapo-product-reviews-form"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/bpr-products-module.css?1730193558341" rel="stylesheet" type="text/css" media="all" />

    <div class="footer-policy">
        <div class="container">
            <div class="row">
                <div class="tt-services-listing clearfix">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="https://dngbike.com/huong-dan-mua-hang" class="tt-services-block">
                            <div class="tt-col-icon">
                                <img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/rolling.svg?1730193558341" data-lazyload="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/fot_policy_image_1.png?1730193558341" alt="Miễn phí vận chuyển" class="img-responsive" />
                            </div>
                            <div class="tt-col-description">
                                <h4 class="tt-title">Miễn phí vận chuyển</h4>
                                <p>Với đơn hàng trên 2 triệu áp dụng Phụ tùng/Phụ kiện</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="/lien-he" class="tt-services-block">
                            <div class="tt-col-icon">
                                <img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/rolling.svg?1730193558341" data-lazyload="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/fot_policy_image_2.png?1730193558341" alt="Hỗ trợ 24/7" class="img-responsive" />
                            </div>
                            <div class="tt-col-description">
                                <h4 class="tt-title">Hỗ trợ 24/7</h4>
                                <p>Hỗ trợ 24h/ngày và 7 ngày/tuần</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="https://dngbike.com/quy-dinh-doi-tra" class="tt-services-block">
                            <div class="tt-col-icon">
                                <img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/rolling.svg?1730193558341" data-lazyload="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/fot_policy_image_3.png?1730193558341" alt="03 ngày đổi trả" class="img-responsive" />
                            </div>
                            <div class="tt-col-description">
                                <h4 class="tt-title">03 ngày đổi trả</h4>
                                <p>Đổi trả hàng trong vòng 03 ngày</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="site-footer">
            <div class="container">
                <div class="footer-inner padding-top-30 padding-bottom-20">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

                            <div class="footer-widget no-border">
                                <h3><span>CÔNG TY TNHH DNG BIKE</span></h3>
                                <ul class="list-menu ul-footer-contact">
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> Số 42 Đặng Thai Mai, Thạc Gián, Thanh Khê, Đà Nẵng </li>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:0912190059">0912190059</a> - <a href="tel:0916790059">0916790059</a></li>
                                    <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:CSKH@dngbike.com">CSKH@dngbike.com</a></li>
                                    <p style="color: #333333;">
                                        Giấy chứng nhận ĐKKD số 0401989856 do Sở KH&ĐT thành phố Đà Nẵng cấp ngày 15/7/2019
                                    </p>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="footer-widget">
                                <h3><span>Hệ thống chi nhánh</span></h3>

                                <b>CN1: GIANT BIKE STORE</b> <br> Số 42 Đặng Thai Mai, P. Thạc Gián, Q. Thanh Khê, Tp. Đà Nẵng <br> Tel: 0916790059 <br>
                                <b>CN2: TREK BIKE STORE </b><br> Số 644-646, Phạm Hùng, Hòa Phước, Hòa Xuân, Tp. Đà Nẵng <br> Tel: 0888430880
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="footer-widget">
                                <h3><span>VỀ CHÚNG TÔI</span></h3>
                                <ul class="list-menu">
                                    <li><a href="/gioi-thieu-cong-ty-tnhh-dngbike">Giới thiệu công ty DNGBIKE</a></li>
                                    <li><a href="/gioi-thieu-ve-team-dngbike">Hoạt động Team DNGBIKE</a></li>
                                    <li><a href="/doi-tac">Đối tác thương hiệu</a></li>
                                    <li><a href="/tuyen-dung">Tuyển dụng nhân sự</a></li>
                                    <li><a href="/danh-gia-cua-khach-hang-ve-dngbike">Đánh giá của khách hàng</a></li>
                                    <li><a href="/xe-dap-the-thao-dngbike">Tìm cửa hàng</a></li>
                                    <li><a href="/gioi-thieu-ve-team-dngbike">Tin tức & các hoạt động</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="footer-widget">
                                <h3><span>TUYỂN DỤNG</span></h3>
                                <ul class="list-menu">
                                    <li><a href="https://dngbike.com/quy-trinh-tuyen-dung-cua-dngbike">Quy trình tuyển dụng</a></li>
                                    <li><a href="/tuyen-dung">Vị trí tuyển dụng</a></li>
                                    <li><a href="https://docs.google.com/forms/d/1PLCJ07DEhZDEIDTWmZ_L9CFVdXurmvvmmNnvTiG-eEk/viewform?edit_requested=true">Ứng tuyển ngay</a></li>
                                    <li><a href="https://dngbike.com/gioi-thieu-ve-cong-ty-dngbike">Tại sao bạn nên chọn DNGBIKE</a></li>
                                </ul>
                            </div>
                            <a href="http://online.gov.vn/Home/WebDetails/78698" target="blank"><img src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/bct.png?1730193558341" style="max-width:70%"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright clearfix">
            <div class="container">
                <div class="inner clearfix">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span>© Bản quyền thuộc về <b>DNGBIKE</b> <span class="s480-f hidden">| Cung cấp bởi <a href="https://www.sapo.vn/?utm_campaign=cpn:site_khach_hang-plm:footer&utm_source=site_khach_hang&utm_medium=referral&utm_content=fm:text_link-km:-sz:&utm_term=&campaign=site_khach_hang" title="Sapo" target="_blank" rel="nofollow">Sapo</a></span></span>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>


    <!-- Bizweb javascript -->
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/option-selectors.js?1730193558341" type="text/javascript"></script>

    <script src="//bizweb.dktcdn.net/assets/themes_support/api.jquery.js" type="text/javascript"></script>

    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/lightbox.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.elevatezoom308.min.js?1730193558341" type="text/javascript"></script>
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.prettyphoto.min005e.js?1730193558341" type="text/javascript"></script>
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.prettyphoto.init.min367a.js?1730193558341" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            // Show tab 1 by default
            $('#tab-1').addClass('current');
            $('.tabs-title li:first').addClass('current');
            
            // Handle tab clicks
            $('.tabs-title li').click(function(){
                var tab_id = $(this).attr('data-tab');
                
                // Remove current class from all tabs and contents
                $('.tabs-title li').removeClass('current');
                $('.tab-content').removeClass('current');
                
                // Add current class to clicked tab and corresponding content
                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            });
        });
        window.addEventListener('scroll', function() {
            var navigation = document.querySelector('.main-navigation');
            var headerHeight = document.querySelector('.header-main').offsetHeight;
            
            if (window.pageYOffset >= headerHeight) {
                navigation.classList.add('sticky-nav');
                // Add padding to body to prevent content jump
                document.body.style.paddingTop = navigation.offsetHeight + 'px';
            } else {
                navigation.classList.remove('sticky-nav');
                document.body.style.paddingTop = 0;
            }
        });


        function addToCart(userId, productId, quantity) {
            const url = '/users/cart';
            
            const data = {
                user_id: userId,
                product_id: productId,
                quantity: quantity
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding to cart. Please try again later.');
            });
        }
    </script>

</body>

</html>