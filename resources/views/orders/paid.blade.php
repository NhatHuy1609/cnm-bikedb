@extends('layouts.app')

@section('content')
<div class="w-[94%] m-10">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary py-4 position-relative">
                    <a href="javascript:history.back()" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Trở về</span>
                    </a>
                    <h4 class="text-center mb-0 text-white font-weight-bold text-uppercase text-2xl">
                        Đơn hàng của tôi
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if($paidOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="w-full table align-middle">
                                <thead>
                                    <tr>
                                        <th class="py-5 text-center">
                                            <span class="text-uppercase text-xs font-weight-bold">Mã đơn hàng</span>
                                        </th>
                                        <th class="py-3 text-center">
                                            <span class="text-uppercase text-xs font-weight-bold">Ngày đặt</span>
                                        </th>
                                        <th class="py-3 text-center">
                                            <span class="text-uppercase text-xs font-weight-bold">Tổng tiền</span>
                                        </th>
                                        <th class="py-3 text-center">
                                            <span class="text-uppercase text-xs font-weight-bold">Trạng thái</span>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paidOrders as $order)
                                    <tr class="order-row">
                                        <td class="text-center py-4">
                                            <div class="order-id-wrapper">
                                                <span class="order-id">#{{ $order->id }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center py-4">
                                            <div class="date-wrapper">
                                            <span class="date-primary">{{ $order->created_at->format('d/m/Y') }}</span>
                                            <span class="date-secondary text-xs text-muted">{{ $order->created_at->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center py-4">
                                            <div class="price-wrapper">
                                            <span class="price-tag">{{ number_format($order->orderItems->sum('price')) }}đ</span>
                                            </div>
                                        </td>
                                        <td class="text-center py-4">
                                            <div class="status-badge">
                                                <i class="fas fa-check-circle pulse"></i>
                                                <span>Đã thanh toán</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="order-items-row">
                                        <td colspan="4" class="p-4">
                                            <div class="order-items-container">
                                                @foreach($order->orderItems as $item)
                                                    <div class="order-item">
                                                        <div class="product-image">
                                                            @if($item->product->productImages->first())
                                                                <img src="{{ $item->product->productImages->first()->link }}" alt="{{ $item->product->name }}">
                                                            @else
                                                                <div class="no-image">No Image</div>
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <h6 class="product-name">{{ $item->product->name }}</h6>
                                                            <p class="product-quantity">Số lượng: {{ $item->quantity }}</p>
                                                            <p class="product-price">{{ number_format($item->price) }}đ</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h5>Bạn chưa có đơn hàng nào đã thanh toán</h5>
                            <p class="text-muted">Hãy khám phá các sản phẩm của chúng tôi</p>
                            <a href="{{ route('products.index') }}" class="btn-shop-now">
                                <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    /* border-radius: 0px 16px; */
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    background: #fff;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #23bf04 0%, #2dd107 100%);
    padding: 1.5rem 1rem;
}

.order-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0,0,0,.08);
    cursor: pointer;
}

.order-row:hover {
    background-color: #f1f5f9;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,.05);
}

.order-id-wrapper {
    background: rgba(35, 191, 4, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.order-id {
    font-weight: 700;
    color: #23bf04;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}

.date-wrapper {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.date-primary {
    font-weight: 600;
    color: #1e293b;
}

.date-secondary {
    font-size: 0.75rem;
    color: #64748b;
}

.price-wrapper {
    display: inline-block;
}

.price-tag {
    background: rgba(16, 185, 129, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 24px;
    border: 2px solid #23bf04;
    border-radius: 12px;
    color: #23bf04;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: #23bf04;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(35, 191, 4, 0.2);
}

.btn-detail i {
    transition: transform 0.3s ease;
}

.btn-detail:hover i {
    transform: translateX(4px);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: #f8fafc;
    border-radius: 16px;
}

.empty-state-icon {
    font-size: 5rem;
    color: #23bf04;
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-state h5 {
    color: #1e293b;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.btn-shop-now {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #23bf04 0%, #2dd107 100%);
    color: white;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 12px rgba(35, 191, 4, 0.3);
    letter-spacing: 0.5px;
}

.btn-shop-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(35, 191, 4, 0.3);
    color: white;
}

.table th {
    font-size: 0.75rem;
    letter-spacing: 1.5px;
    font-weight: 600;
    color: #64748b;
    padding: 16px;
    background: #f8fafc;
}

.card-body {
    width: 100%;
}

@media (max-width: 768px) {
    .card-body {
        padding: 0.75rem;
    }
    
    .btn-detail {
        padding: 8px 16px;
    }
    
    .status-badge, .price-tag {
        padding: 8px 12px;
    }
}

.btn-back {
    position: absolute;
    left: 4%;
    top: 50%;
    transform: translateY(-50%);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-50%) translateX(-2px);
    color: white;
    text-decoration: none;
}

.btn-back i {
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

.btn-back:hover i {
    transform: translateX(-3px);
}

.card-header {
    min-height: 80px;
    width: 100%;
    position: relative;
}

@media (max-width: 768px) {
    .btn-back span {
        display: none;
    }
    
    .btn-back {
        padding: 8px;
    }
}

.order-items-row {
    background-color: #f8fafc;
}

.order-items-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.25rem;
    padding: 1.5rem;
    background: #f8fafc;
}

.order-item {
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.order-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 12px rgba(0,0,0,0.08);
}

.product-image {
    width: 100px;
    height: 100px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e2e8f0;
    color: #64748b;
    font-size: 0.75rem;
}

.product-info {
    flex: 1;
}

.product-name {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.product-quantity {
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.25rem;
}

.product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #10b981;
}

@media (max-width: 768px) {
    .order-items-container {
        grid-template-columns: 1fr;
    }
    
    .product-image {
        width: 80px;
        height: 80px;
    }
}

</style>
@endsection