@extends('layouts.app')

@section('content')
<h1>Giỏ Hàng</h1>

@if($cart && $cart->cartItems->count() > 0)
<ul>
    @foreach($cart->cartItems as $item)
    <li>{{ $item->product->name }} - Số lượng: {{ $item->quantity }}</li>
    @endforeach
</ul>
<form action="{{ route('checkout') }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Checkout with Stripe
    </button>
</form>
@else
<p>Giỏ hàng trống.</p>
@endif
@endsection