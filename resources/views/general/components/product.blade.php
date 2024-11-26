<a
    href="{{ route('products.show', $product->id) }}"
    class="block relative max-w-sm rounded overflow-hidden shadow-lg relative flex flex-col justify-between cursor-pointer hover:opacity-80">
    <!-- Discount badge -->
    @if ($product->discount)
        <div class="absolute top-0 left-0 bg-red-600 text-white px-4 py-1 z-10 text-sm">
            Giảm {{ $product->discount->percentage }}%
        </div>
    @endif

    <!-- Product image -->
    <div class="relative">
        <img class="w-full" src="{{ $product->productImages[0]->link }}" alt="{{ $product->name }}">
    </div>

    <!-- Product info -->
    <div class="px-4 py-3 flex flex-col justify-between flex-1">
        <!-- Promotion badge -->
        <div class="flex items-center mb-2">
            <span class="bg-red-600 text-white text-[8px] px-3 py-1 rounded-full flex items-center">
                RẺ VÔ ĐỐI - RẺ HƠN HOÀN TIỀN
            </span>
        </div>

        <!-- Product name -->
        <h3 class="text-xs mb-2">{{ $product->name }}</h3>

        <!-- Price -->
        <div class="flex gap-2 items-center">
            @if ($product->discount)
                @php
                    $sale_price = $product->price * (1 - $product->discount->percentage / 100);
                @endphp
                <span class="text-green-500 font-bold text-base">{{ $sale_price }}đ</span>
            @endif
            <span class="text-sm {{ $product->discount ? 'line-through text-gray-500' : 'text-green-500' }}">{{ $product->price }} đ</span>
        </div>
    </div>
</a>