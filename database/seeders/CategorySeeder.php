<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Bikes',
            'parent_category_id' => null
        ]);

        Category::create([
            'name' => 'Mountain Bikes',
            'parent_category_id' => 1
        ]);

        Category::create([
            'name' => 'Road Bikes',
            'parent_category_id' => 1
        ]);

        Category::create([
            'name' => 'Accessories',
            'parent_category_id' => null
        ]);
    }
}
