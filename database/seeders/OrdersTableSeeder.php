<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

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
                'total_price' => 199.99,
                'status' => 'pending',
                'items' => [
                    ['product_id' => 1, 'quantity' => 1, 'price' => 199.99],
                ],
            ],
            [
                'user_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'address' => '456 Elm St',
                'country' => 'Canada',
                'total_price' => 444.99,
                'status' => 'completed',
                'items' => [
                    ['product_id' => 2, 'quantity' => 1, 'price' => 444.99],
                ],
            ],
        ];

        foreach ($orders as $orderData) {
            // Create order
            $order = Order::create([
                'user_id' => $orderData['user_id'],
                'first_name' => $orderData['first_name'],
                'last_name' => $orderData['last_name'],
                'address' => $orderData['address'],
                'country' => $orderData['country'],
                'total_price' => $orderData['total_price'],
                'status' => $orderData['status'],
            ]);

            // Add order items
            foreach ($orderData['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }
    }
}
