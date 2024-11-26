<div class='w-[300px] bg-white h-full'>
    <div class="pl-4 text-xl text-black font-semibold mb-[-12px]">
        Bộ lọc
    </div>
    @if(request()->has('brands') || request()->has('priceRange') || request()->has('sortByPrice'))
        <div class="pl-4">
            <form method="GET" action="{{ route('general.index') }}">
                <button type="submit" class="w-full text-sm bg-gray-500 text-white px-4 py-1 max-w-fit rounded-md">
                    Hủy bỏ lọc
                </button>
            </form>
        </div>
    @endif
    @include('general.components.brandFilter')
    @include('general.components.priceFilter')
    @include('general.components.sortPriceFilter')
</div>