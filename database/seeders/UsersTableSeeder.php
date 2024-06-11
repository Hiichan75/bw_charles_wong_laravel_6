<?php

// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => '123@123.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => '1234@1234.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}

