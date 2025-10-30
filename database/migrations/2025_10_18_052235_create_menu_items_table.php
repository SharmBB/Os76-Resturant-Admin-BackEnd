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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_visible')->default(true);

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('menu_list_id')->nullable(); 

            $table->decimal('price', 8, 2);
            $table->decimal('compare_at_price', 8, 2)->nullable();
            $table->enum('type', ['Veg', 'Non_veg']);
            $table->string('product_code')->nullable();
            $table->text('description')->nullable();
            $table->boolean('track_inventory_enabled')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('menu_categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('menu_subcategories')->onDelete('set null');
            $table->foreign('menu_list_id')->references('id')->on('menu_management_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
