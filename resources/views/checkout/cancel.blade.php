@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <!-- Biểu tượng -->
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" viewBox="0 0 24 24" class="text-red-500">
                    <path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m4.3 14.3a.996.996 0 0 1-1.41 0L12 13.41L9.11 16.3a.996.996 0 1 1-1.41-1.41L10.59 12L7.7 9.11A.996.996 0 1 1 9.11 7.7L12 10.59l2.89-2.89a.996.996 0 1 1 1.41 1.41L13.41 12l2.89 2.89c.38.38.38 1.02 0 1.41" />
                </svg>
            </div>
            <!-- Tiêu đề -->
            <h1 class="text-3xl font-bold text-gray-800">Đặt hàng không thành công</h1>
            <p class="text-gray-600 mt-2">Rất tiếc, đã xảy ra lỗi trong quá trình thanh toán. Vui lòng kiểm tra và thử lại.</p>
        </div>

        <!-- Gợi ý xử lý -->
        <div class="bg-gray-50 p-4 rounded-lg border mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Hướng dẫn</h2>
            <ul class="space-y-2 text-sm text-gray-600">
                <li>• Kiểm tra lại thông tin thanh toán hoặc số dư tài khoản.</li>
                <li>• Liên hệ ngân hàng nếu cần hỗ trợ.</li>
                <li>• Nếu vấn đề tiếp diễn, vui lòng <a href="{{ url('/support') }}" class="text-blue-500 hover:underline">liên hệ chúng tôi</a>.</li>
            </ul>
        </div>

        <!-- Nút hành động -->
        <div class="flex justify-center space-x-4">
            <a href="{{ url('/general') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                Quay lại giỏ hàng
            </a>
            <a href="{{ url('/') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">
                Về trang chủ
            </a>
        </div>
    </div>
</div>

@endsection