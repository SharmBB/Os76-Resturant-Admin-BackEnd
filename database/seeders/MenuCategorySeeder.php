<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('menu_categories')->insert([
            'name' => 'Home Made example',
            'description' => 'A variety of delicious meals including rice, pasta, and curry dishes.',
            'img' => 'main_dishes.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
