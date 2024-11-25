<!DOCTYPE html>
<html lang="vi">



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Cart
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
        .carousel-inner>.item>img {
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .main-navigation {
            width: 100%;
            transition: all 0.3s ease;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Keep header section -->
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
                            <a href="/cart" title="Cart">
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
                                    <a href="/cart" class="header-cart">
                                        <i class="ion ion-md-basket"></i> Giỏ hàng <span class="cart-wishlist-number cartCount">{{ count($cart['cart_items']) }}</span>
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

    <!-- After header, before footer -->
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Giỏ hàng của bạn</h2>
                <div class="table-responsive">
                    <table class="table table-striped" data-cart-id="{{ $cart['id'] }}">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart['cart_items'] as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item['product']['first_image'] }}" alt="product image" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $item['product']['name'] }}</td>
                                <td>${{ number_format($item['product']['price'], 2) }}</td>
                                <td>
                                    <input type="number"
                                        class="form-control"
                                        style="width: 80px;"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        onchange="updateQuantity('{{ $item['product_id'] }}', this.value)">
                                </td>
                                <td>${{ number_format($item['product']['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="removeItem('{{ $item['product_id'] }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="/" class="btn btn-default">Tiếp tục mua hàng</a>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Thanh toán
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(productId, change) {
            const cartId = document.querySelector('table').dataset.cartId;

            fetch(`/carts`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        cart_id: cartId,
                        quantity: parseInt(change)
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Cart update failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating cart. Please try again later.');
                });
        }

        function removeItem(productId) {
            const cartId = document.querySelector('table').dataset.cartId;
            if (confirm('Are you sure you want to delete this product?')) {
                fetch(`/carts`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            cart_id: cartId
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating cart. Please try again later.');
                    });
            }
        }
    </script>

    <!-- Keep footer section -->
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

    <!-- Keep scripts -->
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/option-selectors.js?1730193558341" type="text/javascript"></script>
    <script src="//bizweb.dktcdn.net/assets/themes_support/api.jquery.js" type="text/javascript"></script>
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/lightbox.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.elevatezoom308.min.js?1730193558341" type="text/javascript"></script>
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.prettyphoto.min005e.js?1730193558341" type="text/javascript"></script>
    <script src="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/jquery.prettyphoto.init.min367a.js?1730193558341" type="text/javascript"></script>

    <script>
        // Keep only the sticky navigation script
        window.addEventListener('scroll', function() {
            var navigation = document.querySelector('.main-navigation');
            var headerHeight = document.querySelector('.header-main').offsetHeight;

            if (window.pageYOffset >= headerHeight) {
                navigation.classList.add('sticky-nav');
                document.body.style.paddingTop = navigation.offsetHeight + 'px';
            } else {
                navigation.classList.remove('sticky-nav');
                document.body.style.paddingTop = 0;
            }
        });
    </script>

</body>

</html>