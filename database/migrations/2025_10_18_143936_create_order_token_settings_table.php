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
        Schema::create('order_token_settings', function (Blueprint $table) {
            $table->id();
            $table->string('token_prefix')->nullable();
            $table->integer('token_num_start')->nullable();
            $table->integer('token_num_end')->nullable();
            $table->string('token_suffix')->nullable();
            $table->boolean('token_daily_reset_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_token_settings');
    }
};
