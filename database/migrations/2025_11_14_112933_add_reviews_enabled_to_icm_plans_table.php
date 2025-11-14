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
        Schema::table('icm_plans', function (Blueprint $table) {
            // 1. Tambahkan kolom 'description'
            // Kita buat nullable() untuk amannya
            $table->text('description')->nullable();

            // 2. Tambahkan kolom 'reviews_enabled'
            $table->boolean('reviews_enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('icm_plans', function (Blueprint $table) {
            // Jika di-rollback, hapus kedua kolom
            $table->dropColumn(['description', 'reviews_enabled']);
        });
    }
};