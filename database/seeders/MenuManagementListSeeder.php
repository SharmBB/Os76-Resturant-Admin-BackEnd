<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuManagementListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('menu_management_lists')->insert([
            'name' => 'Standard Menu example',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
