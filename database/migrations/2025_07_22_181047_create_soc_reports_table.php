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
        Schema::create('soc_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete(); // Relasi ke tabel cities
            $table->year('tahun');
            $table->string('ss_lingkungan')->nullable(); // Screenshot 1
            $table->string('ss_tata_kelola')->nullable(); // Screenshot 2
            $table->string('ss_pembangunan')->nullable(); // Screenshot 3
            $table->string('ss_matriks_icm')->nullable(); // Screenshot 4
            $table->timestamps();

            $table->unique(['city_id', 'tahun']); // Pastikan data unik untuk kota & tahun yg sama
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soc_reports');
    }
};
