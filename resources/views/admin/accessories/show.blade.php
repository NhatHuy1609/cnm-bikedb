@extends('admin.layouts.app')

@section('title', 'View Accessory')

@section('content')
<div class="w-full mt-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        {{-- Header Section --}}
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">{{ $accessory->name }}</h1>
        </div>

        {{-- Product Images --}}
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Product Images</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($accessory->productImages as $image)
                    <div class="relative aspect-square">
                        <img src="{{ asset($image->link) }}" 
                             alt="{{ $accessory->name }}"
                             class="w-full h-full object-cover rounded-lg">
                    </div>
                @empty
                    <p class="text-gray-500 italic col-span-full">No images available</p>
                @endforelse
            </div>
        </div>

        {{-- Product Details --}}
        <div class="p-6 grid grid-cols-2 gap-6">
            {{-- Left Column --}}
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Brand</h3>
                    <p class="text-gray-800">{{ $accessory->brand ? ucfirst($accessory->brand->name) : 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Quantity</h3>
                    <div class="flex items-center space-x-2">
                        <p class="text-lg font-semibold text-gray-800">{{ $accessory->quantity }}</p>
                        @if($accessory->quantity <= 5)
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">
                                Low Stock
                            </span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Last Updated</h3>
                    <p class="text-gray-800">{{ $accessory->updated_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Category</h3>
                    <p class="text-gray-800">{{ $accessory->category->name }}</p>
                    @if($accessory->category->parent_category)
                        <p class="text-gray-500 text-sm">{{ $accessory->category->parent_category->name }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Price</h3>
                    <div class="flex items-center gap-2">
                        @if($accessory->discount)
                            <p class="text-gray-500 line-through italic">${{ number_format($accessory->price, 2) }}</p>
                            <p class="text-lg font-semibold text-gray-800">
                                ${{ number_format($accessory->price * (1 - $accessory->discount->percentage / 100), 2) }}
                            </p>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ $accessory->discount->percentage }}% OFF
                            </span>
                        @else
                            <p class="text-lg font-semibold text-gray-800">${{ number_format($accessory->price, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Description Section --}}
        @if($accessory->description)
        <div class="p-6 border-t border-gray-200">
            <h2 class="text-lg font-medium text-gray-800 mb-2">Description</h2>
            <p class="text-gray-600 whitespace-pre-line">{{ $accessory->description }}</p>
        </div>
        @endif

        <div class="flex justify-between items-center p-6 border-t border-gray-200">
            <a href="{{ route('admin.accessories.index') }}" 
                class="px-4 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 flex items-center gap-2">
                <i class="fas fa-chevron-left"></i>
                Back
            </a>
            <a href="{{ route('admin.accessories.edit', $accessory) }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
