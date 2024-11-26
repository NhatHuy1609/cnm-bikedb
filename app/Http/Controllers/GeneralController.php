<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\GeneralCategoryService;
use App\Http\Requests\ProductFilterRequest;
use App\Models\Product;
class GeneralController extends Controller
{
    protected $productService;
    protected $generalCategoryService;

    public function __construct(ProductService $productService, GeneralCategoryService $generalCategoryService)
    {
        $this->productService = $productService;
        $this->generalCategoryService = $generalCategoryService;
    }

    public function index(ProductFilterRequest $request)
    {
        $priceRanges = [
            [
                'id' => 1,
                'name' => 'Giá dưới 500.000đ',
                'min' => 0,
                'max' => 500000,
            ],
            [
                'id' => 2,
                'name' => '500.000đ - 5.000.000đ',
                'min' => 500000,
                'max' => 5000000,
            ],
            [
                'id' => 3,
                'name' => '5.000.000đ - 20.000.000đ',
                'min' => 5000000,
                'max' => 20000000,
            ],
            [
                'id' => 4,
                'name' => '20.000.000đ - 50.000.000đ',
                'min' => 20000000,
                'max' => 50000000,
            ],
        ];
        $sortOrderByPrice = [
            [
                'id' => 1,
                'name' => 'Giá thấp đến cao',
            ],
            [
                'id' => 2,
                'name' => 'Giá cao xuống thấp',
            ]
        ];

        $categoryId = $request->category ?? 2;
        $highestCategories = $this->generalCategoryService->getAllHighestLevelCategories();
        $category = $this->generalCategoryService->getCategoryById($categoryId);

        // Get filters from request and save to session
        $filters = $request->getFilters();
        session()->put('selected_brands', $filters['brands']);
        session()->put('selected_price_range', $filters['priceRange']);
        session()->put('selected_sort_by_price', $filters['sortByPrice']);

        // Get selected brands from session
        $selectedBrands = session('selected_brands', []);
        $selectedPriceRange = session('selected_price_range', null);
        $selectedSortByPrice = session('selected_sort_by_price', null);

         // Apply filters to query
        $query = Product::query();

        if ($category->parent_category_id) {
            $query->where('category_id', $category->id);
        }

        if (!$category->parent_category_id) {
            $categoryIds = $category->where('parent_category_id', $categoryId)->pluck('id')->toArray();
            $categoryIds[] = $categoryId;
            $query->whereIn('category_id', $categoryIds);
        }

        if (!empty($selectedBrands)) {
            $query->whereIn('brand_id', $selectedBrands);
        }

        if ($selectedPriceRange) {
            $query->where('price', '>=', $priceRanges[$selectedPriceRange - 1]['min'])
                  ->where('price', '<=', $priceRanges[$selectedPriceRange - 1]['max']);
        }

        if ($selectedSortByPrice) {
            $query->orderBy('price', $selectedSortByPrice == 1 ? 'asc' : 'desc');
        }


        // Get products with pagination
        $products = $query->paginate(8);

        return view('general.index', [
            'products' => $products,
            'category' => $category,
            'highestCategories' => $highestCategories,
            'priceRanges' => $priceRanges,
            'sortOrderByPrice' => $sortOrderByPrice,
            'selectedBrands' => $selectedBrands,
            'selectedPriceRange' => $selectedPriceRange,
            'selectedSortByPrice' => $selectedSortByPrice,
        ]);
    }
}
