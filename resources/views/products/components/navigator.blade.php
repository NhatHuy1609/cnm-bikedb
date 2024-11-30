<div class="main-navigation">
    <nav class='w-full px-16 h-[64px] border-b border-gray-200 bg-black flex items-center main-navigation'>
        @foreach ($highestCategories as $category)
            <div class='relative h-full group'>
                <a href="{{ route('general.index', ['category' => $category->id]) }}" class="h-full flex items-center justify-center text-white px-6 hover:bg-green-500 hover:text-white">
                    {{ $category->name }} >
                </a>
                <div class='group-hover:block hidden max-w-[300px] w-[300px] h-auto absolute top-[100%] left-0 bg-white text-black shadow-lg'>
                    @php
                        $subCategories = $category->subCategories;
                    @endphp
                    @foreach ($subCategories as $subCategory)
                        <div class='h-auto border-b border-gray-200 relative group/subsubitem'>
                            <a href="{{ route('general.index', ['category' => $subCategory->id]) }}" class="block py-2 h-full flex items-center justify-start text-black px-6 hover:bg-green-500 hover:text-white">
                                {{ $subCategory->name }} >
                            </a>
                            @php
                                $subSubCategories = $subCategory->subCategories;
                            @endphp
                            <div class='group-hover/subsubitem:block hidden absolute top-0 left-[100%] bg-white text-black shadow-lg flex flex-col'>
                                @foreach ($subSubCategories as $subSubCategory)
                                    <a href="{{ route('general.index', ['category' => $subSubCategory->id]) }}" class="block py-2 h-full flex items-center justify-start text-black px-6 hover:bg-green-500 hover:text-white">
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