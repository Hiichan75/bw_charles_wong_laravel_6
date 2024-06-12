<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FAQTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('f_a_q_s')->insert([
            [
                'question' => 'What is your refund policy?',
                'answer' => 'You can request a refund within 30 days of purchase.',
                'category_id' => 1, // Ensure this matches an existing category ID
                'user_id' => 1, // Replace with an existing user ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How can I update my billing information?',
                'answer' => 'You can update your billing information in your account settings.',
                'category_id' => 2,
                'user_id' => 1, // Replace with an existing user ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How do I reset my password?',
                'answer' => 'Click on "Forgot Password" and follow the instructions to reset your password.',
                'category_id' => 1,
                'user_id' => 1, // Replace with an existing user ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'How do I contact technical support?',
                'answer' => 'You can contact technical support via the "Contact Us" page or by emailing support@example.com.',
                'category_id' => 3,
                'user_id' => 1, // Replace with an existing user ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'Why is my account locked?',
                'answer' => 'Your account may be locked due to multiple failed login attempts. Please contact support to unlock it.',
                'category_id' => 3,
                'user_id' => 1, // Replace with an existing user ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
