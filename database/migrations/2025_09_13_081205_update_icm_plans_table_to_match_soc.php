<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('icm_plans', function (Blueprint $table) {
            // Menyamakan nama kolom file utama
            $table->renameColumn('file_path', 'file_laporan');

            // Menambahkan 4 kolom screenshot baru
            $table->string('ss_lingkungan')->nullable()->after('description');
            $table->string('ss_tata_kelola')->nullable()->after('ss_lingkungan');
            $table->string('ss_pembangunan')->nullable()->after('ss_tata_kelola');
            $table->string('ss_matriks_icm')->nullable()->after('ss_pembangunan');
        });
    }
    public function down(): void {
        Schema::table('icm_plans', function (Blueprint $table) {
            $table->renameColumn('file_laporan', 'file_path');
            $table->dropColumn(['ss_lingkungan', 'ss_tata_kelola', 'ss_pembangunan', 'ss_matriks_icm']);
        });
    }
};
