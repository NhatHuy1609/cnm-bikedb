<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class
        ]);
    }
}
