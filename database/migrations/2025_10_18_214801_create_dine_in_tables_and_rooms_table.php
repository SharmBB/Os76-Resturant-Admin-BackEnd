<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dine_in_tables_and_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('table_num')->nullable();
            $table->string('room_num')->nullable();

            $table->string('table_name')->nullable();
            $table->string('room_name')->nullable();

            $table->string('table_qr_code')->nullable();
            $table->string('room_qr_code')->nullable();

            $table->integer('num_of_tables')->default(0);
            $table->integer('num_of_rooms')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dine_in_tables_and_rooms');
    }
};
