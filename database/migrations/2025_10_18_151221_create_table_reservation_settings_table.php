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
        Schema::create('table_reservation_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('table_reservation_enabled')->default(false); 
            $table->boolean('display_menu_on_customer_web')->default(false); 

            $table->integer('slot_duration')->default(30); 
            $table->integer('num_of_booking')->default(0); 
            $table->integer('max_no_guest')->default(0); 

            $table->boolean('cancellation_deadline')->default(false); 
            // i can not understand this cancellation process
            
            $table->integer('booking_availability_period'); 
            $table->text('term_and_conditions')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_restaurant_settings');
    }
};
