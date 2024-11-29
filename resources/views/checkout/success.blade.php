@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
        <div class="text-center">
            <!-- Icon Success -->
            <div class="flex justify-center items-center rounded-full w-24 h-24 mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" viewBox="0 0 1024 1024" class="text-green-500">
                    <path fill="currentColor" d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z"/>
                </svg>
            </div>
            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Đặt hàng thành công!</h1>
            <!-- Subtitle -->
            <p class="text-gray-600 leading-relaxed">
                Cảm ơn bạn đã mua hàng! Chúng tôi đã nhận được đơn hàng của bạn và sẽ xử lý ngay.
            </p>
        </div>

        <!-- CTA -->
        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-block bg-blue-500 text-white font-medium px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>

@endsection