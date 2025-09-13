<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regional_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('indicator_name'); // Contoh: "Luas Hutan Mangrove (ha)"
            $table->string('indicator_value'); // Contoh: "1,250.75"
            $table->year('year'); // Contoh: 2024
            $table->string('source')->nullable(); // Contoh: "Dinas Kelautan & Perikanan"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regional_data');
    }
};
