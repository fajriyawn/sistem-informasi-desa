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
        Schema::table('soc_reports', function (Blueprint $table) {
            $table->boolean('reviews_enabled')->default(true)->after('file_laporan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soc_reports', function (Blueprint $table) {
            $table->dropColumn('reviews_enabled');
        });
    }
};