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
        Schema::create('pos_address_field_settings', function (Blueprint $table) {
            $table->id();
            // Order type toggles
            $table->boolean('takeaway_enabled')->default(true);
            $table->boolean('delivery_enabled')->default(false);
            $table->boolean('dine_in_enabled')->default(false);

            // Field visibility settings
            $table->enum('mobile_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('name_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('email_visibility', ['Optional', 'Required', 'Hide'])->default('Optional');
            $table->enum('instruction_visibility', ['Optional', 'Required', 'Hide'])->default('Optional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_address_field_settings');
    }
};
