<div class="main-navigation">
    <nav class='w-full px-16 h-[64px] border-b border-gray-200 bg-black flex items-center z-50'>
        @foreach ($highestCategories as $category)
            <div class='relative h-full group/main'>
                <a href="{{ route('general.index', ['category' => $category->id]) }}" 
                   class="h-full flex items-center justify-center text-white px-6 hover:bg-green-500 hover:text-white">
                    {{ $category->name }} >
                </a>
                <div class='invisible group-hover/main:visible absolute top-[100%] left-0 bg-white text-black shadow-lg w-[300px] z-[1000]'>
                    @php
                        $subCategories = $category->subCategories;
                    @endphp
                    @foreach ($subCategories as $subCategory)
                        <div class='h-auto relative group/sub border-b border-gray-200'>
                            <a href="{{ route('general.index', ['category' => $subCategory->id]) }}" 
                               class="block py-2 flex items-center justify-start text-black px-6 hover:bg-green-500 hover:text-white">
                                {{ $subCategory->name }} >
                            </a>
                            @php
                                $subSubCategories = $subCategory->subCategories;
                            @endphp
                            <div class='invisible group-hover/sub:visible absolute top-0 left-[100%] bg-white text-black shadow-lg min-w-[200px] z-[1001]'>
                                @foreach ($subSubCategories as $subSubCategory)
                                    <a href="{{ route('general.index', ['category' => $subSubCategory->id]) }}" 
                                       class="block py-2 flex items-center justify-start text-black px-6 hover:bg-green-500 hover:text-white">
                                        {{ $subSubCategory->name }} >
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>
</div>