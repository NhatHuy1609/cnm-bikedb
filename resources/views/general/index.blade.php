@extends('layouts.general')

@section('content')
    <div class='w-full h-full bg-white'>
        <div class='text-xl text-black font-semibold my-2'>{{$category->name}}</div>
        <div class='grid grid-cols-4 gap-4'>
            @foreach ($products as $product)
                @include('general.components.product', ['product' => $product])
            @endforeach
        </div>
        <div class='w-full mt-4'>
            {{ $products->links() }}
        </div>
    </div>
@endsection
