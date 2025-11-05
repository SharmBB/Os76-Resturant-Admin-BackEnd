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
        Schema::create('menu_item_outlet_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_img')->nullable();
            $table->string('sku')->nullable(); // Stock Keeping Unit (Thumbs-Up, 200ml => SKU == TUMS-200ML)
            $table->integer('available_quantity')->default(0);
            $table->boolean('allow_out_of_stock_sales')->default(false);

            // Foreign keys
            $table->foreignId('menu_variant_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('menu_item_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('outlet_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_outlet_inventories');
    }
};
