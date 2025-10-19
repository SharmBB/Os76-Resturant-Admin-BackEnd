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
        Schema::create('custom_checkout_forms', function (Blueprint $table) {
            $table->id();
            $table->string('field_name'); 
            $table->string('field_type'); 

            // Context toggles
            $table->boolean('takeaway_enabled')->default(false);
            $table->boolean('delivery_enabled')->default(false);
            $table->boolean('dine_in_enabled')->default(false);
            $table->boolean('table_room_enabled')->default(false);
            $table->boolean('take_order_enabled')->default(false);

            // Field behavior
            $table->boolean('is_hide_enabled')->default(false);
            $table->boolean('is_required_enabled')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_checkout_forms');
    }
};
