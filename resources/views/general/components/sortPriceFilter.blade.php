<div class="w-full max-w-xs p-4 border-b border-gray-200">
    <h2 class="text-base font-medium mb-2">Sắp xếp theo giá</h2>
    
    <!-- Price list -->
    <form method="GET" action="{{ route('general.index') }}" class="space-y-2 max-h-60 overflow-y-auto" id="sort-by-price-list">
        @foreach ($sortOrderByPrice as $sortByPrice)
            <label class="flex items-center gap-2 space-x-2 cursor-pointer">
                <input 
                    type="radio"
                    name="sortByPrice"
                    value="{{ $sortByPrice['id'] }}"
                    class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-500"
                    {{ $selectedSortByPrice == $sortByPrice['id'] ? 'checked' : '' }}
                >
                <span class="text-gray-700 text-sm sort-by-price-name">{{ $sortByPrice['name'] }}</span>
            </label>
        @endforeach

        @foreach ($selectedBrands as $brandId)
            <input type="hidden" name="brands[]" value="{{ $brandId }}">
        @endforeach

        @if($selectedPriceRange)
            <input type="hidden" name="priceRange" value="{{ $selectedPriceRange }}">
        @endif

        @if($category) 
            <input type="hidden" name="category" value="{{ $category->id }}">
        @endif
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#sort-by-price-list input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                document.getElementById('sort-by-price-list').submit();
            });
        });
    });
</script>