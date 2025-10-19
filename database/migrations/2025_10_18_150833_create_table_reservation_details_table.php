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
        Schema::create('table_reservation_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_num');
            $table->date('date_to_come');
            $table->time('time_to_come');
            $table->integer('num_of_guests');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Relationships
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_details');
    }
};
