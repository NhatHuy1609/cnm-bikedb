@extends('admin.layouts.app')

@section('title', 'Edit Accessory')

@section('content')
<div class="w-full mt-8">
    <form method="POST" action="{{ route('admin.accessories.update', $accessory->id) }}" enctype="multipart/form-data" class="p-10 bg-white rounded shadow-xl max-w-3xl mx-auto">
        @csrf
        @method('PUT')
        <p class="text-lg text-gray-800 font-medium pb-4">Edit accessory</p>
        
        {{-- Basic Information Section --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="name" name="name" type="text" required placeholder="Accessory name" value="{{ old('name', $accessory->name) }}">
        </div>

        {{-- Price and Quantity Row --}}
        <div class="mt-2 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600" for="price">Price (USD)</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="price" name="price" type="number" min="0" step="0.01" required placeholder="0.00" value="{{ old('price', $accessory->price) }}">
            </div>

            <div>
                <label class="block text-sm text-gray-600" for="quantity">Quantity</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="quantity" name="quantity" min="0" type="number" placeholder="0" value="{{ old('quantity', $accessory->quantity) }}">
            </div>
        </div>

        {{-- Brand Selection --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="brand_id">Brand</label>
            <select class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="brand_id" name="brand_id" required>
                <option value="">--- Select Brand ---</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $accessory->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ ucfirst($brand->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Category Selection Section --}}
        <div class="mt-2" id="category-container">
            <label class="block text-sm text-gray-600">Category</label>
            
            <div class="space-y-2">
                {{-- Level 1 Category Dropdown --}}
                <div class="flex items-center gap-2">
                    <select class="flex-1 px-5 py-2 text-gray-700 bg-gray-100 rounded category-select" 
                            data-level="1" 
                            name="category_level_1" 
                            required>
                        <option value="">--- Select Category ---</option>
                        @foreach($parentCategories as $category)
                            <option value="{{ $category['id'] }}" 
                                    {{ $accessory->category->parent_category_id == $category['id'] ? 'selected' : '' }}
                                    data-has-children="{{ $category['has_children'] ? 'true' : 'false' }}">
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Level 2 Category Dropdown (Pre-loaded) --}}
                <div class="flex items-center gap-2">
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <select class="flex-1 px-5 py-2 text-gray-700 bg-gray-100 rounded category-select" 
                            data-level="2" 
                            name="category_level_2" 
                            required>
                        <option value="">--- Select Subcategory ---</option>
                        @foreach($subCategories as $category)
                            <option value="{{ $category['id'] }}" 
                                    {{ $accessory->category_id == $category['id'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Final Selected Category Storage --}}
                <input type="hidden" name="category_id" id="final_category_id" value="{{ old('category_id', $accessory->category_id) }}">
            </div>
        </div>

        {{-- Description Field --}}
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="description">Description</label>
            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-100 rounded" id="description" name="description" rows="3" placeholder="Accessory description">{{ old('description', $accessory->description) }}</textarea>
        </div>

        {{-- Image Upload Section --}}
        <div class="mt-6">
            <label class="block text-sm text-gray-600">Product Images</label>
            <div id="image-container" class="mt-2">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="image-preview-container">
                    {{-- Existing Images --}}
                    @foreach($accessory->productImages as $image)
                    <div class="relative group" data-image-id="{{ $image->id }}">
                        <img src="{{ asset($image->image_path) }}" class="w-full h-32 object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button type="button" class="text-white hover:text-red-500 transition-colors" onclick="deleteImage(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    
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
                <i class="fa-solid fa-save"></i>
                Update
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image handling functions
    window.handleImageUpload = function(input) {
        const files = input.files;
        const uploadLabel = document.querySelector('label[for="image-upload"]');
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = createImagePreview(e.target.result);
                uploadLabel.parentNode.insertBefore(previewDiv, uploadLabel);
            };
            reader.readAsDataURL(file);
        }
    };

    window.deleteImage = function(button) {
        const imageContainer = button.closest('.relative');
        const imageId = imageContainer.dataset.imageId;
        
        // Add to deleted images list if it's an existing image
        if (imageId) {
            const deletedImagesInput = document.getElementById('deleted-images');
            const deletedImages = deletedImagesInput.value ? deletedImagesInput.value.split(',') : [];
            deletedImages.push(imageId);
            deletedImagesInput.value = deletedImages.join(',');
        }

        // Animate and remove the image container
        imageContainer.style.opacity = '0';
        setTimeout(() => {
            imageContainer.remove();
        }, 200);
    };

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
            deleteImage(deleteBtn);
        };
        
        overlay.appendChild(deleteBtn);
        div.appendChild(img);
        div.appendChild(overlay);
        
        div.style.opacity = '0';
        div.style.transition = 'opacity 200ms ease-in-out';
        setTimeout(() => {
            div.style.opacity = '1';
        }, 10);
        
        return div;
    }

    // Category handling
    const finalCategoryInput = document.getElementById('final_category_id');
    const categorySelects = document.querySelectorAll('.category-select');

    categorySelects.forEach(select => {
        select.addEventListener('change', function() {
            if (this.dataset.level === '2') {
                finalCategoryInput.value = this.value;
            }
        });
    });
});
</script>
@endpush
