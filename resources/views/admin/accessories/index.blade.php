@extends('admin.layouts.app')

@section('title', 'Manage Accessories')

@section('content')
<div class="w-full mt-12">
    <div class="flex justify-between items-center pb-6">
        <div class="flex-1"></div>
        <a href="{{ route('admin.accessories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i>Add New Accessory
        </a>
    </div>

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
                @forelse ($accessories as $accessory)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">#{{ $accessory->id }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12">
                                <img class="w-full h-full rounded object-cover"
                                    src="{{ $accessory->productImages->first()?->link ?? 'https://placehold.co/150' }}"
                                    alt="{{ $accessory->name }}" />
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                    {{ $accessory->name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            @if($accessory->brand)
                                {{ ucfirst($accessory->brand->name) }}
                            @else
                                <span class="text-muted-background italic">N/A</span>
                            @endif
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $accessory->category->name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <p class="text-gray-900 whitespace-no-wrap font-medium">
                            ${{ number_format($accessory->price, 2) }}
                        </p>
                        @if($accessory->discount)
                        <p class="text-green-600 whitespace-no-wrap text-xs">
                            {{ $accessory->discount->percentage }}% OFF
                        </p>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex flex-col items-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $accessory->quantity }}
                            </p>
                            @if($accessory->quantity <= 5)
                                <span class="text-red-500 text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 border border-red-200">Low Stock</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $accessory->updated_at->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600 text-xs">
                            {{ $accessory->updated_at->format('h:i A') }}
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex space-x-3 justify-center">
                            <a href="{{ route('admin.accessories.edit', $accessory) }}" 
                               class="text-blue-600 hover:text-blue-900"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.accessories.destroy', $accessory) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Are you sure you want to delete this accessory?')"
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
                        No accessories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $accessories->links() }}
    </div>
</div>
@endsection
