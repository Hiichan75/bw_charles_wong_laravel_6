<?php

// database/seeders/NewsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        News::create([
            'title' => 'News Title 1',
            'content' => 'Content for News 1',
            'published_at' => now(),
            'user_id' => 1 // Assuming the user_id exists
        ]);

        News::create([
            'title' => 'News Title 2',
            'content' => 'Content for News 2',
            'published_at' => now(),
            'user_id' => 1 // Assuming the user_id exists
        ]);

        News::create([
            'title' => 'News Title 3',
            'content' => 'Content for News 3',
            'published_at' => now(),
            'user_id' => 2 // Assuming the user_id exists
        ]);
    }
}
