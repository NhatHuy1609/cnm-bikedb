<div class="w-full max-w-xs p-4 border-b border-gray-200">
    <h2 class="text-base font-medium mb-2">Thương hiệu</h2>
    
    <!-- Search input -->
    <div class="relative mb-4">
        <input
            type="text" 
            name="brand_search"
            id="brand-search"
            placeholder="Tìm Thương hiệu"
            class="w-full px-3 py-2 border border-gray-300 rounded-sm text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
        >
        <button 
            type="button"
            class="absolute right-0 top-0 h-full px-3 bg-green-600 text-white rounded-r-sm hover:bg-green-600 focus:outline-none"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>

    <!-- Brand list -->
    <form method="GET" action="{{ route('general.index') }}" class="space-y-2 max-h-60 overflow-y-auto" id="brand-list">
        @foreach ($category->brands as $brand)
            <label class="flex items-center gap-2 space-x-2 cursor-pointer">
                <input 
                    type="checkbox"
                    name="brands[]"
                    value="{{ $brand->id }}"
                    class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-500"
                    {{ in_array($brand->id, $selectedBrands) ? 'checked' : '' }}
                >
                <span class="text-gray-700 text-sm brand-name">{{ strtoupper($brand->name) }}</span>
            </label>
        @endforeach

        @if($selectedPriceRange)
            <input type="hidden" name="priceRange" value="{{ $selectedPriceRange }}">
        @endif

        @if($selectedSortByPrice)
            <input type="hidden" name="sortByPrice" value="{{ $selectedSortByPrice }}">
        @endif

        @if($category) 
            <input type="hidden" name="category" value="{{ $category->id }}">
        @endif

        <label class="flex items-center gap-2 space-x-2 cursor-pointer">
            <input type="checkbox" name="brands[]" value="other" class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-500">
            <span class="text-gray-700 text-sm">XE ĐẠP KHÁC</span>
        </label>

        <button type="submit" class="hidden">Apply Filters</button>
    </form>
</div>

<script>
    

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('brand-search');
        const brandList = document.getElementById('brand-list');
        const brands = brandList.querySelectorAll('.brand-name');

        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.toLowerCase();
            
            brands.forEach((brand) => {
                const label = brand.closest('label');
                if (brand.textContent.toLowerCase().includes(searchText)) {
                    label.style.display = 'flex'; // Show matching brands
                } else {
                    label.style.display = 'none'; // Hide non-matching brands
                }
            });
        });

        document.querySelectorAll('#brand-list input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                document.getElementById('brand-list').submit();
            });
        });
    });
</script>