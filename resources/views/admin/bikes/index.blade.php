@extends('admin.layouts.app')

@section('title', 'Manage Bikes')

@section('content')
<div class="w-full mt-8">
    <div class="flex justify-between items-center pb-6">
        <div class="flex-1"></div>
        <a href="{{ route('admin.bikes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i>Add New Bike
        </a>
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
                        Last Updated
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
                                    <a href="{{ route('admin.bikes.show', $bike) }}" class="hover:text-blue-600 hover:underline">
                                        {{ $bike->name }}
                                    </a>
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
                            {{ $bike->updated_at->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600 text-xs">
                            {{ $bike->updated_at->format('h:i A') }}
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex space-x-3 justify-center">
                            <a href="{{ route('admin.bikes.edit', $bike) }}" 
                               class="text-blue-600 hover:text-blue-900"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.bikes.destroy', $bike) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Are you sure you want to delete this bike?')"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-5 bg-white text-sm text-center">
                        No bikes found.
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
