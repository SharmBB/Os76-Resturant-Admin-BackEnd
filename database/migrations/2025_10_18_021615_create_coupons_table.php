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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->enum('type', ['fixed', 'percentage'])->default('fixed');
            $table->decimal('discount_amount', 8, 2)->default(0.00);
            $table->enum('usage_time', ['multiple_time', 'single_time'])->default('single_time');
            $table->date('activation_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('coupon_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
