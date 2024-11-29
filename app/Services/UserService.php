<?php

namespace App\Services;

use App\Models\User;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function getUserCart(int $userId)
    {
        try {
            $data = Cart::where('user_id', $userId)
                ->with(['cartItems.product', 'cartItems.product.productImages' => function($query) {
                    $query->limit(1);
                }])
                ->first();
            
            if (!$data) {
                return null; // Return null if no cart found
            }
    
            $formattedData = [
                'id' => $data->id,
                'user_id' => $data->user_id,
                'cart_items' => []
            ];
    
            foreach ($data->cartItems as $item) {
                $product = $item->product;
    
                $discountedPrice = $product->price;
                if ($product->discount && $product->discount->percentage > 0) {
                    $discountedPrice = $product->price - ($product->price * ($product->discount->percentage / 100));
                }
    
                $formattedData['cart_items'][] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'product' => [
                        'name' => $product->name,
                        'price' => $discountedPrice,
                        'first_image' => $product->productImages->first()->link ?? null
                    ]
                ];
            }
    
            return $formattedData;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}