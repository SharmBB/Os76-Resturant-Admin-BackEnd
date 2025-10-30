<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outlets')->insert([
            'outlet_name' => 'Downtown Cafe example',
            'address_line_1' => '123 Main Street',
            'address_line_2' => 'Near City Park',
            'city' => 'Colombo',
            'pin_zip_code' => '10000',
            'latitude' => 6.9271,
            'longitude' => 79.8612,
            'qr_code' => 'downtown-cafe-qr.png',
            'status' => true,
            'outlet_web_url' => 'https://downtowncafe.lk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
