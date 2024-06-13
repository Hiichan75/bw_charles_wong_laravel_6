<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AdminUserSeeder::class,
            UsersTableSeeder::class,
            NewsTableSeeder::class,
            FAQCategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            OrdersTableSeeder::class,
            ForumPostsTableSeeder::class,
            ContactMessagesTableSeeder::class,
            FAQTableSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}