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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    @include('carts.components.header')

    <!-- After header, before footer -->
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Giỏ hàng của bạn</h2>
                <div class="table-responsive">
                    <table class="table table-striped" data-cart-id="{{ $cart['id'] ?? '' }}">
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
                            @if(empty($cart['cart_items']))
                            <tr>
                                <td colspan="6" class="text-center">
                                    <span style="font-size: 20px; font-weight: bold;">Chưa có sản phẩm trong giỏ hàng</span>
                                </td>
                            </tr>
                            @else
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
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="/" class="btn btn-default">Tiếp tục mua hàng</a>
                    <form action="{{ route('checkout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
         <a href="{{ route('users') }}" 
                class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>  
            </a>   
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
    @include('carts.components.footer')

    <script>
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

    <a href="{{ route('users') }}" 
        class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>  
    </a>    

</body>

</body>

</html>