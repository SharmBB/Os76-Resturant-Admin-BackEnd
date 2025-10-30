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
        Schema::create('menu_list_outlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_management_list_id');
            $table->unsignedBigInteger('outlet_id');

            $table->foreign('menu_management_list_id')->references('id')->on('menu_management_lists')->onDelete('cascade');
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_list_outlets');
    }
};
