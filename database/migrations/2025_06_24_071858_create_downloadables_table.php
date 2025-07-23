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
        Schema::create('downloadables', function (Blueprint $table) {
            $table->id();
            $table->string('region');         // Nama kota atau kabupaten
            $table->enum('type', ['SOC', 'ICM']);
            $table->year('year');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadables');
    }
};
