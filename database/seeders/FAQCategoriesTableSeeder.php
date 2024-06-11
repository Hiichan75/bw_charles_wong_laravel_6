<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('f_a_q_categories')->insert([
            ['name' => 'General'],
            ['name' => 'Billing'],
            ['name' => 'Technical Support'],
        ]);
    }
}
