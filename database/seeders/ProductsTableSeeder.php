<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            [
                'name' => 'Nintendo Switch',
                'description' => 'Description for Product 1',
                'price' => 199.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Playstation 5',
                'description' => 'Description for Product 2',
                'price' => 444.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gaming PC',
                'description' => 'Description for Product 3',
                'price' => 1549.99,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
