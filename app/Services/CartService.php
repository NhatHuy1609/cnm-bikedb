<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class CartService
{
    protected $cartItems;

    public function __construct(CartItem $cartItems)
    {
        $this->cartItems = $cartItems;
    }

    public function updateQuantity($params)
    {
        try {
            $cartItem = $this->cartItems
                ->where('cart_id', $params['cart_id'])
                ->where('product_id', $params['product_id'])
                ->first();

            if (!$cartItem) {
                throw new Exception('Could not find product');
            }

            $totalQuantityInCart = $this->cartItems
                ->where('cart_id', $params['cart_id'])
                ->where('product_id', $params['product_id'])
                ->sum('quantity');

            $totalQuantityInCart += $params['quantity'];

            if ($totalQuantityInCart > $cartItem->product->quantity) {
                throw new Exception("Total quantity requested exceeds quantity in stock");
            }

            $this->cartItems
                ->where('cart_id', $params['cart_id'])
                ->where('product_id', $params['product_id'])
                ->update(['quantity' => $params['quantity']]);
            
            return $cartItem->fresh();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($params)
    {
        try {
            $cartItem = $this->cartItems
                ->where('cart_id', $params['cart_id'])
                ->where('product_id', $params['product_id'])
                ->first();
    
            if (!$cartItem) {
                throw new Exception('Could not find product in cart');
            }
    
            $cartItem->delete();
    
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function store($params)
    {
        try {
            $cart = Cart::where('user_id', $params['user_id'])->first();

            if (!$cart) {
                $cart = Cart::create(['user_id' => $params['user_id']]);
            }

            $cartItem = $this->cartItems
                ->where('cart_id', $cart->id)
                ->where('product_id', $params['product_id'])
                ->first();

            $totalQuantityInCart = $cartItem ? $cartItem->quantity : 0;
            $totalQuantityInCart += $params['quantity'];

            $product = Product::find($params['product_id']);
            if (!$product) {
                throw new Exception("Product not found");
            }

            if ($totalQuantityInCart > $product->quantity) {
                throw new Exception("Quantity requested exceeds quantity in stock");
            }
            
            if ($cartItem) {
                $cartItem->quantity = $totalQuantityInCart;
                $cartItem->save();
                return $cartItem;
            }

            $params['cart_id'] = $cart->id;
            $cartItem = $this->cartItems->create($params);
    
            return $cartItem;

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}