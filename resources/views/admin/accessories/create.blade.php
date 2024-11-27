@extends('admin.layouts.app')

@section('title', 'Create Accessory')

@section('content')
<div class="w-full mt-8">
    {{-- Main Form Container --}}
    <form method="POST" action="{{ route('admin.accessories.store') }}" enctype="multipart/form-data" class="p-10 bg-white rounded shadow-xl max-w-3xl mx-auto">
        @csrf
        <p class="text-lg text-gray-800 font-medium pb-4">Add new accessory</p>
        
        {{-- Basic Information Section --}}
        {{-- Accessory Name Field --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="name" name="name" type="text" required placeholder="Accessory name" value="{{ old('name') }}">
        </div>

        {{-- Price and Quantity Row --}}
        <div class="mt-2 grid grid-cols-2 gap-4">
            {{-- Price Field --}}
            <div>
                <label class="block text-sm text-gray-600" for="price">Price (USD)</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="price" name="price" type="number" min="0" step="0.01" required placeholder="0.00" value="{{ old('price') }}">
            </div>

            {{-- Quantity Field --}}
            <div>
                <label class="block text-sm text-gray-600" for="quantity">Quantity</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="quantity" name="quantity" min="0" type="number" placeholder="0" value="{{ old('quantity') }}">
            </div>
        </div>

        {{-- Brand Selection --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="brand_id">Brand</label>
            <select class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="brand_id" name="brand_id" required>
                <option value="">--- Select Brand ---</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                        {{ ucfirst($brand->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Category Selection Section --}}
        <div class="mt-2" id="category-container">
            <label class="block text-sm text-gray-600">Category</label>
            
            <div class="space-y-2">
                {{-- Dynamic Category Dropdown System --}}
                <div class="flex items-center gap-2">
                    <select class="flex-1 px-5 py-2 text-gray-700 bg-gray-100 rounded category-select" 
                            data-level="1" 
                            name="category_level_1" 
                            required>
                        <option value="">--- Select Category ---</option>
                        @foreach($subCategories as $category)
                            <option value="{{ $category['id'] }}" 
                                    {{ old('category_id') == $category['id'] ? 'selected' : '' }}
                                    data-has-children="{{ $category['has_children'] ? 'true' : 'false' }}">
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Loading State Indicator --}}
                <div id="category-loading" class="hidden">
                    <div class="flex items-center gap-2 text-gray-500">
                        <i class="fas fa-circle-notch fa-spin"></i>
                        <span class="text-sm">Loading subcategories...</span>
                    </div>
                </div>

                {{-- Final Selected Category Storage --}}
                <input type="hidden" name="category_id" id="final_category_id" value="{{ old('category_id') }}">
            </div>
        </div>

        {{-- Description Field --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="description">Description</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="description" name="description" rows="3" placeholder="Accessory description">{{ old('description') }}</textarea>
        </div>

        {{-- Image Upload Section --}}
        <div class="mt-6">
            <label class="block text-sm text-gray-600">Product Images</label>
            <div id="image-container" class="mt-2">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="image-preview-container">
                    {{-- Image Preview Grid --}}
                    
                    {{-- Upload Button --}}
                    <label for="image-upload" class="cursor-pointer group">
                        <div class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center gap-2 group-hover:border-blue-500 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 group-hover:text-blue-500"></i>
                            <span class="text-sm text-gray-500 group-hover:text-blue-500">Upload Image</span>
                        </div>
                        <input type="file" 
                                id="image-upload" 
                                name="images[]" 
                                multiple 
                                accept="image/*"
                                class="hidden"
                                onchange="handleImageUpload(this)">
                    </label>
                </div>

                {{-- Deleted Images Tracking --}}
                <input type="hidden" name="deleted_images" id="deleted-images" value="">
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.accessories.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center gap-2">
                <i class="fa-solid fa-chevron-left"></i>
                Back
            </a>
            <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-500 hover:bg-blue-700 rounded flex items-center gap-2" type="submit">
                <i class="fa-solid fa-plus"></i>
                Add
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// JavaScript section handles:
// 1. Dynamic category selection and subcategory loading
// 2. Image upload preview and management
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
                // Show loading indicator
                loadingIndicator.classList.remove('hidden');
                
                // Disable current select while loading
                select.disabled = true;

                // Fetch child categories
                const response = await fetch(`/api/categories/${selectedId}/children`);
                const children = await response.json();

                if (children.length > 0) {
                    createCategoryDropdown(level + 1, children);
                }
            } catch (error) {
                console.error('Error fetching subcategories:', error);
                // Show error message to user
                const errorDiv = document.createElement('div');
                errorDiv.className = 'text-red-500 text-sm mt-1';
                errorDiv.textContent = 'Failed to load subcategories. Please try again.';
                categoryContainer.querySelector('.space-y-2').appendChild(errorDiv);
            } finally {
                // Hide loading indicator
                loadingIndicator.classList.add('hidden');
                // Re-enable current select
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
        select.className = 'flex-1 px-5 py-1 text-gray-700 bg-gray-200 rounded category-select';
        select.dataset.level = level;
        select.name = `category_level_${level}`;

        // Add loading state styles
        select.classList.add('transition-opacity', 'duration-200');
        select.style.opacity = '0';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select Subcategory';
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

        // Animate the new dropdown
        requestAnimationFrame(() => {
            select.style.opacity = '1';
        });
    }

    function removeSubsequentDropdowns(level) {
        const dropdowns = categoryContainer.querySelectorAll('.category-select');
        dropdowns.forEach(dropdown => {
            if (parseInt(dropdown.dataset.level) > level) {
                const container = dropdown.closest('.flex.items-center');
                // Fade out animation
                container.style.opacity = '0';
                setTimeout(() => {
                    container.remove();
                }, 200);
            }
        });
    }

    // Initialize image preview container
    const previewContainer = document.getElementById('image-preview-container');
    
    function handleImageUpload(input) {
        const files = input.files;
        const uploadLabel = document.querySelector('label[for="image-upload"]');
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = createImagePreview(e.target.result);
                // Insert before the upload label instead of appending to container
                uploadLabel.parentNode.insertBefore(previewDiv, uploadLabel);
            };
            reader.readAsDataURL(file);
        }
    }

    function createImagePreview(src) {
        const div = document.createElement('div');
        div.className = 'relative group';
        
        const img = document.createElement('img');
        img.src = src;
        img.className = 'w-full h-32 object-cover rounded-lg';
        
        const overlay = document.createElement('div');
        overlay.className = 'absolute inset-0 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center';
        
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'text-white hover:text-red-500 transition-colors';
        deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
        deleteBtn.onclick = function() {
            div.style.opacity = '0';
            setTimeout(() => {
                div.remove();
            }, 200);
        };
        
        overlay.appendChild(deleteBtn);
        div.appendChild(img);
        div.appendChild(overlay);
        
        // Add fade-in animation
        div.style.opacity = '0';
        div.style.transition = 'opacity 200ms ease-in-out';
        setTimeout(() => {
            div.style.opacity = '1';
        }, 10);
        
        return div;
    }

    // Make function available globally
    window.handleImageUpload = handleImageUpload;
});
</script>
@endpush
