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
        Schema::create('rating_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('customers_rate_store_enabled')->default(true);
            $table->boolean('show_store_ratings_enabled')->default(true);
            $table->boolean('customers_rate_products_enabled')->default(true);
            $table->boolean('show_products_ratings_enabled')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_settings');
    }
};
