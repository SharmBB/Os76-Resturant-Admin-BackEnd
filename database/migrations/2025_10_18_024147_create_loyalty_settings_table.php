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
        Schema::create('loyalty_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true); 
            $table->boolean('custom_status')->default(false); 
            $table->integer('credit_expiry_days')->nullable(); 
            $table->boolean('signup_points_enabled')->default(false); 
            $table->boolean('spend_points_enabled')->default(false); 
            $table->boolean('order_amount_points_enabled')->default(false); 
            $table->boolean('order_type_points_enabled')->default(false); 
            $table->decimal('currency_value', 8, 2)->default(1.00); 
            $table->boolean('redeem_points_enabled')->default(false); 
            $table->timestamps();

            //Relationship
            $table->foreignId('outlet_id')->nullable()->constrained('outlets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_programs');
    }
};
