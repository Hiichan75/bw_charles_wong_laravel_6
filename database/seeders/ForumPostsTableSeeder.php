<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumPost;
use App\Models\ForumReply;

class ForumPostsTableSeeder extends Seeder
{
    public function run()
    {
        $posts = ForumPost::insert([
            [
                'title' => 'Forum Post 1',
                'content' => 'Content for Forum Post 1',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Forum Post 2',
                'content' => 'Content for Forum Post 2',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        ForumReply::insert([
            [
                'forum_post_id' => 1,
                'content' => 'Reply to Forum Post 1',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'forum_post_id' => 2,
                'content' => 'Reply to Forum Post 2',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
