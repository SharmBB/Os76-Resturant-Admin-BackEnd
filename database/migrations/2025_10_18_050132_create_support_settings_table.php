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
        Schema::create('support_settings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_care_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('customer_care_email')->nullable();
            $table->timestamps();

            // Relationship
            $table->foreignId('outlet_id')->nullable()->constrained('outlets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_settings');
    }
};
