<div class="w-full max-w-xs p-4 border-b border-gray-200">
    <h2 class="text-base font-medium mb-2">Giá sản phẩm</h2>
    
    <!-- Price list -->
    <form method="GET" action="{{ route('general.index') }}" class="space-y-2 max-h-60 overflow-y-auto" id="price-range-list">
        @foreach ($priceRanges as $priceRange)
            <label class="flex items-center gap-2 space-x-2 cursor-pointer">
                <input 
                    type="radio"
                    name="priceRange"
                    value="{{ $priceRange['id'] }}"
                    class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-500"
                    {{ $selectedPriceRange == $priceRange['id'] ? 'checked' : '' }}
                >
                <span class="text-gray-700 text-sm price-range-name">{{ $priceRange['name'] }}</span>
            </label>
        @endforeach

        @foreach ($selectedBrands as $brandId)
            <input type="hidden" name="brands[]" value="{{ $brandId }}">
        @endforeach

        @if($selectedSortByPrice)
            <input type="hidden" name="sortByPrice" value="{{ $selectedSortByPrice }}">
        @endif

        @if($category) 
            <input type="hidden" name="category" value="{{ $category->id }}">
        @endif
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#price-range-list input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                document.getElementById('price-range-list').submit();
            });
        });
    });
</script>