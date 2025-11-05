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
        Schema::create('menu_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_item_id'); 
            $table->string('variant_name');
            $table->decimal('price', 8, 2);
            $table->decimal('compare_at_price', 8, 2)->nullable();
            $table->boolean('track_inventory_enabled')->default(false); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_variants');
    }
};
