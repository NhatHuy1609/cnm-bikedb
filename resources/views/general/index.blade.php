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

         <a href="{{ route('users') }}" 
                class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>  
            </a>   
    </div>
@endsection
