<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    public function getProductsByCategory($categoryId, $perPage = 8)
    {
        return $this->product->where('category_id', $categoryId)->paginate($perPage);
    }
}
