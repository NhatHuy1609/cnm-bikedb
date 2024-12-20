@extends('admin.layouts.app')

@section('title', 'Manage Accessories')

@section('content')
<div class="w-full mt-12">
    <div class="flex gap-4 items-center pb-4">
        <h2 class="text-lg font-semibold">All Accessories</h2>
        <a href="{{ route('admin.accessories.trash') }}" 
           class="text-sm text-blue-500 hover:text-blue-800">
            <i class="fas fa-trash mr-2"></i>View Deleted Accessories
        </a>
    </div>
    <div class="flex justify-between items-center pb-4">
        <form action="{{ route('admin.accessories.index') }}" method="GET" class="flex items-center gap-2">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search accessories..."
                       class="w-[450px] pl-8 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 mr-2"></i>
                </div>
                @if(request('search'))
                <a href="{{ route('admin.accessories.index') }}" 
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
                    <div class="mb-4" id="category-container">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        
                        <div class="space-y-2">
                            <!-- Main Category Dropdown -->
                            <div class="flex items-center gap-2">
                                <select class="w-full p-2 h-10 rounded-md border border-gray-300 category-select" 
                                        data-level="1" 
                                        name="category_level_1">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ request('category') == $category->id ? 'selected' : '' }}
                                                data-has-children="{{ $category->subCategories->isNotEmpty() ? 'true' : 'false' }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Loading Indicator -->
                            <div id="category-loading" class="hidden">
                                <div class="flex items-center gap-2 text-gray-500">
                                    <i class="fas fa-circle-notch fa-spin"></i>
                                    <span class="text-sm">Loading subcategories...</span>
                                </div>
                            </div>

                            <!-- Final Selected Category Input -->
                            <input type="hidden" name="category" id="final_category_id" value="{{ request('category') }}">
                        </div>
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
                        <a href="{{ route('admin.accessories.index') }}" 
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
        <a href="{{ route('admin.accessories.create') }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i>Add New Accessory
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
                                    <a href="{{ route('admin.accessories.show', $accessory) }}" class="hover:text-blue-600 hover:underline">
                                        {{ $accessory->name }}
                                    </a>
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
                            @if($accessory->discount)
                                ${{ number_format($accessory->price * (1 - $accessory->discount->percentage / 100), 2) }}
                                <p class="text-green-600 whitespace-no-wrap text-xs">
                                    {{ $accessory->discount->percentage }}% OFF
                                </p>
                            @else
                                ${{ number_format($accessory->price, 2) }}
                            @endif
                        </p>
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
        if (closeFlash) {
            closeFlash.addEventListener('click', function() {
                flashMessage.style.opacity = '0';
                setTimeout(() => {
                    flashMessage.remove();
                }, 500); // Allow time for fade-out transition
            });
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const categoryContainer = document.getElementById('category-container');
    const finalCategoryInput = document.getElementById('final_category_id');
    const loadingIndicator = document.getElementById('category-loading');

    // Handle category selection
    categoryContainer.addEventListener('change', async function(e) {
        if (!e.target.classList.contains('category-select')) return;

        const select = e.target;
        const level = parseInt(select.dataset.level);
        const selectedOption = select.options[select.selectedIndex];
        const hasChildren = selectedOption.dataset.hasChildren === 'true';
        const selectedId = select.value;

        // Always update the final category ID with the current selection
        finalCategoryInput.value = selectedId;

        // Remove all subsequent dropdowns
        removeSubsequentDropdowns(level);

        if (hasChildren && selectedId) {
            try {
                loadingIndicator.classList.remove('hidden');
                select.disabled = true;

                const response = await fetch(`/api/categories/${selectedId}/children`);
                const children = await response.json();

                if (children.length > 0) {
                    createCategoryDropdown(level + 1, children);
                }
            } catch (error) {
                console.error('Error fetching subcategories:', error);
            } finally {
                loadingIndicator.classList.add('hidden');
                select.disabled = false;
            }
        }
    });

    function createCategoryDropdown(level, categories) {
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        
        const icon = document.createElement('i');
        icon.className = 'fas fa-chevron-right text-gray-400 text-xs';
        div.appendChild(icon);
        
        const select = document.createElement('select');
        select.className = 'w-full p-2 h-10 rounded-md border border-gray-300 category-select';
        select.dataset.level = level;
        select.name = `category_level_${level}`;
        select.style.opacity = '0';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'All Subcategories';
        select.appendChild(defaultOption);

        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            option.dataset.hasChildren = category.has_children;
            select.appendChild(option);
        });

        div.appendChild(select);
        categoryContainer.querySelector('.space-y-2').appendChild(div);

        requestAnimationFrame(() => {
            select.style.opacity = '1';
        });
    }

    function removeSubsequentDropdowns(level) {
        const dropdowns = categoryContainer.querySelectorAll('.category-select');
        dropdowns.forEach(dropdown => {
            if (parseInt(dropdown.dataset.level) > level) {
                const container = dropdown.closest('.flex.items-center');
                container.style.opacity = '0';
                setTimeout(() => {
                    container.remove();
                }, 200);
            }
        });
    }

    // Initialize subcategories if category is already selected
    if (finalCategoryInput.value) {
        const initialSelect = document.querySelector('.category-select[data-level="1"]');
        const event = new Event('change');
        initialSelect.dispatchEvent(event);
    }
});
</script>
@endpush
