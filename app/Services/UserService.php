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
            
            $formattedData = [
                'id' => $data->id,
                'user_id' => $data->user_id,
                'cart_items' => []
            ];

            foreach ($data->cartItems as $item) {
                $formattedData['cart_items'][] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'product' => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'first_image' => $item->product->productImages->first()->link ?? null
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