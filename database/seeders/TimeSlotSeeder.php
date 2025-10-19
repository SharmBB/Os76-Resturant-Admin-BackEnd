<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days as $day) {
            DB::table('time_slots')->insert([
                'day' => $day,
                'message_when_store_offline' => "We're closed now. Please check back later.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
