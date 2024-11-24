@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
            <h1 class="text-2xl font-bold text-gray-800">Đặt hàng thành công!</h1>
            <p class="text-gray-600 mt-2">Cảm ơn bạn đã mua hàng. Chúng tôi sẽ xử lý đơn hàng của bạn ngay.</p>
        </div>

        <div class="border-t pt-4">
            <a href="{{ url('/') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
@endsection