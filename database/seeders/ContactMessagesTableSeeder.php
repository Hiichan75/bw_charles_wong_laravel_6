<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactForm;

class ContactMessagesTableSeeder extends Seeder
{
    public function run()
    {
        ContactForm::insert([
            [
                'name' => 'John Doe',
                'email' => '123@123.com',
                'message' => 'This is a message from John Doe.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => '1234@1234.com',
                'message' => 'This is a message from Jane Smith.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
