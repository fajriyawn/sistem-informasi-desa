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
            $table->string('file_laporan')->nullable()->after('ss_matriks_icm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soc_reports', function (Blueprint $table) {
            //
        });
    }
};
