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
        Schema::create('time_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('open_24_hours_enabled')->default(false); 
            $table->boolean('closed_status')->default(false); 

            $table->time('open_time')->nullable();  
            $table->time('close_time')->nullable(); 

            // Foreign key(days)
            $table->foreignId('time_slots_id')->constrained('time_slots')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_settings');
    }
};
