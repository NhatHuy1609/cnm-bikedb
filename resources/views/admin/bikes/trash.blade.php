@extends('admin.layouts.app')

@section('title', 'Deleted Bikes')

@section('content')
<div class="w-full mt-8">
    <div class="flex flex-col gap-2 items-start pb-4">
        <a href="{{ route('admin.bikes.index') }}" 
           class="text-sm text-blue-500 hover:text-blue-800">
            <i class="fas fa-chevron-left mr-2"></i>Back
        </a>
        <h2 class="text-lg font-semibold">Deleted Bikes</h2>
    </div>

    <div class="flex items-center pb-4">
        <form action="{{ route('admin.bikes.index') }}" method="GET" class="flex items-center gap-2">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search bikes..."
                       class="w-[450px] pl-8 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 mr-2"></i>
                </div>
                @if(request('search'))
                <a href="{{ route('admin.bikes.index') }}" 
                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </div>

            <div class="relative" x-data="{ open: false }">
                <button type="button" 
                        @click="open = !open"
                        class="border bg-white border-gray-300 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg inline-flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Filters
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>

                <div x-show="open" 
                     @click.away="open = false"
                     class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 p-4">
                    
                    <!-- Brand Filter -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                        <select name="brand" class="w-full p-2 h-10 rounded-md border border-gray-300">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ ucfirst($brand->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category" class="w-full p-2 h-10 rounded-md border border-gray-300">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                        <div class="flex gap-2 items-center">
                            <input type="number" name="min_price" placeholder="Min" 
                                   value="{{ request('min_price') }}"
                                   class="w-1/2 p-2 h-10 rounded-md border border-gray-300">
                            <span>-</span>
                            <input type="number" name="max_price" placeholder="Max"
                                   value="{{ request('max_price') }}"
                                   class="w-1/2 p-2 h-10 rounded-md border border-gray-300">
                        </div>
                    </div>

                    <!-- Quantity Filter -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stock Status</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="in_stock" value="1" 
                                       {{ request('in_stock') ? 'checked' : '' }}
                                       class="rounded border border-gray-300">
                                <span class="ml-2">In Stock</span>
                            </label>
                            <br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="low_stock" value="1"
                                       {{ request('low_stock') ? 'checked' : '' }}
                                       class="rounded border border-gray-300">
                                <span class="ml-2">Low Stock (≤ 5)</span>
                            </label>
                            <br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="out_of_stock" value="1"
                                       {{ request('out_of_stock') ? 'checked' : '' }}
                                       class="rounded border border-gray-300">
                                <span class="ml-2">Out of Stock</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.bikes.index') }}" 
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            Clear All
                        </a>
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-500" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <span id="close-flash" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
                </svg>
            </span>
        </div>
    @elseif(session('error'))
        <div id="flash-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative transition-opacity duration-500" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white overflow-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Product
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Brand
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Category
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Price
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Deleted At
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bikes as $bike)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">#{{ $bike->id }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12">
                                <img class="w-full h-full rounded object-cover"
                                    src="{{ $bike->productImages->first()?->link ?? 'https://placehold.co/150' }}"
                                    alt="{{ $bike->name }}" />
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                    {{ $bike->name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            @if($bike->brand)
                                {{ ucfirst($bike->brand->name) }}
                            @else
                                <span class="text-muted-background italic">N/A</span>
                            @endif
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $bike->category->name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <p class="text-gray-900 whitespace-no-wrap font-medium">
                            @if($bike->discount)
                                ${{ number_format($bike->price * (1 - $bike->discount->percentage / 100), 2) }}
                                <p class="text-green-600 whitespace-no-wrap text-xs">
                                    {{ $bike->discount->percentage }}% OFF
                                </p>
                            @else
                                ${{ number_format($bike->price, 2) }}
                            @endif
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex flex-col items-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $bike->quantity }}
                            </p>
                            @if($bike->quantity <= 5)
                                <span class="text-red-500 text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 border border-red-200">Low Stock</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $bike->deleted_at->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600 text-xs">
                            {{ $bike->deleted_at->format('h:i A') }}
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex space-x-3 justify-center">
                            <form action="{{ route('admin.bikes.restore', $bike) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="text-indigo-600 hover:text-indigo-900"
                                        onclick="return confirm('Are you sure you want to restore this bike?')"
                                        title="Restore">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.bikes.force-delete', $bike) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Are you sure you want to permanently delete this bike? This action cannot be undone.')"
                                        title="Delete Permanently">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-5 py-5 bg-white text-sm text-center">
                        No deleted bikes found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bikes->links('pagination::tailwind') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('flash-message');
    const closeFlash = document.getElementById('close-flash');

    if (flashMessage) {
        // Auto-close after 3 seconds
        setTimeout(() => {
            flashMessage.style.opacity = '0';
            setTimeout(() => {
                flashMessage.remove();
            }, 500); // Allow time for fade-out transition
        }, 3000);

        // Manual close on click
        closeFlash.addEventListener('click', function() {
            flashMessage.style.opacity = '0';
            setTimeout(() => {
                flashMessage.remove();
            }, 500); // Allow time for fade-out transition
        });
    }
});
</script>
@endpush