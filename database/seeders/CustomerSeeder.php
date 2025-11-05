<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'name' => 'amal example',
            'mobile' => '0712345678',
            'email' => 'amalsantha@example.com',
            'status' => true,
            'created_at' => now(),
        ]);
    }
}
