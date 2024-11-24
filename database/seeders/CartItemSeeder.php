<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        CartItem::create([
            'cart_id' => 1,
            'product_id' => 1,
            'quantity' => 1
        ]);

        CartItem::create([
            'cart_id' => 1,
            'product_id' => 3,
            'quantity' => 2
        ]);
    }
}
