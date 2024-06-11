<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'user_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'address' => '123 Main St',
                'country' => 'USA',
                'total_price' => 31.98,
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'address' => '456 Oak St',
                'country' => 'Canada',
                'total_price' => 45.50,
                'status' => 'completed',
            ],
            // Add more orders as needed
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
