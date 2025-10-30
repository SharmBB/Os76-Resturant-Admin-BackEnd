<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('menu_items')->insert([
            'name' => 'Grilled Chicken Burger example',
            'is_visible' => true,
            'category_id' => 1, 
            'subcategory_id' => null, 
            'price' => 850.00,
            'compare_at_price' => 950.00,
            'type' => 'Non_veg',
            'product_code' => 'GB001',
            'description' => 'Juicy grilled chicken breast served with lettuce, tomato, and special sauce.',
            'track_inventory_enabled' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
