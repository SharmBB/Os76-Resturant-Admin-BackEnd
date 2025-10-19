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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Status and type
            $table->enum('order_status', ['New Order', 'Confirmed', 'Preparing', 'Ready for pickup', 'Order Completed', 'Cancelled'])->default('New Order');
            $table->enum('type', ['Dine-in', 'Takeaway', 'Delivery'])->default('Dine-in');

            // Payment
            $table->enum('payment_mode', ['cod', 'online'])->default('cod');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            // Relationships
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
