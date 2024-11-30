<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
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

    public function show($product, $userId)
    {
        $product->load('productImages');
    
        // Check for discount
        if ($product->discount && $product->discount->percentage > 0) {
            $product->promotionalPrice = $product->price - ($product->price * ($product->discount->percentage / 100));
        } else {
            $product->promotionalPrice = 0;
        }
    
        $hasPurchased = $userId ? Order::where('user_id', $userId)
            ->where('status', 'paid')
            ->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists() : false; 
    
        $ratings = Rating::where('product_id', $product->id)->get();
    
        return [
            'product' => $product,
            'hasPurchased' => $hasPurchased,
            'ratings' => $ratings,
        ];
    }
}
