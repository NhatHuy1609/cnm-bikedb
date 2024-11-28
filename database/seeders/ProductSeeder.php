<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Mountain Bike Pro',
            'price' => 999.99,
            'description' => 'Professional mountain bike for advanced riders',
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Road Master 2000',
            'price' => 1299.99,
            'description' => 'High-performance road bike',
            'category_id' => 3
        ]);

        Product::create([
            'name' => 'Helmet Pro',
            'price' => 89.99,
            'description' => 'Safety first with this professional helmet',
            'category_id' => 4
        ]);
    }
}
