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
        Schema::create('order_settings', function (Blueprint $table) {
            $table->id();
            // Order type toggles
            $table->boolean('order_type_dine_in_enabled')->default(true);
            $table->boolean('order_type_takeaway_enabled')->default(true);
            $table->boolean('order_type_delivery_enabled')->default(true);

            // Payment settings
            $table->boolean('cod_enabled')->default(true);
            $table->string('change_cod_display_name')->nullable();
            $table->string('change_online_payment_display_name')->nullable();

            // Delivery condition
            $table->integer('min_cart_value_for_delivery')->nullable();

            $table->string('fssai_num')->nullable();
            $table->string('gst_num')->nullable();

            // Orders
            $table->boolean('pre_order_enabled')->default(false);
            $table->boolean('show_inactive_menu_items')->default(false);
            $table->boolean('auto_accept_orders_enabled')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_settings');
    }
};
