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
        Schema::create('general_checkout_settings', function (Blueprint $table) {
            $table->id();
            $table->text('checkout_notes')->nullable(); 
            $table->boolean('round_off_order_amount_enabled')->default(false); 
            $table->boolean('tip_feature_enabled')->default(false); 
            $table->boolean('guest_checkout_customer_web_enabled')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_checkout_settings');
    }
};
