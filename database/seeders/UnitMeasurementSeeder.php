<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_measurements')->insert([
            ['measurement_name' => 'Kilogram', 'created_at' => now(), 'updated_at' => now()],
            ['measurement_name' => 'Gram', 'created_at' => now(), 'updated_at' => now()],
            ['measurement_name' => 'Liter', 'created_at' => now(), 'updated_at' => now()],
            ['measurement_name' => 'Milliliter', 'created_at' => now(), 'updated_at' => now()],
            ['measurement_name' => 'Piece', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
