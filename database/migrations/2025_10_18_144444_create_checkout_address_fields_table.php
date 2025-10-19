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
        Schema::create('checkout_address_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('flat_house_office_no_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('address_line_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('landmark_visibility', ['Optional', 'Required', 'Hide'])->default('Optional');
            $table->enum('state_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('city_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('pin_zip_code_visibility', ['Optional', 'Required', 'Hide'])->default('Required');
            $table->enum('use_current_location_visibility', ['Optional', 'Required', 'Hide'])->default('Optional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_address_fields');
    }
};
