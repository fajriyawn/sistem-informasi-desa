<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('download_logs', function (Blueprint $table) {
            $table->dropForeign(['soc_report_id']);
            $table->dropColumn('soc_report_id');

            // Menambahkan kolom polimorfik
            $table->morphs('downloadable'); // Ini akan membuat downloadable_id dan downloadable_type
        });
    }
    public function down(): void {
        Schema::table('download_logs', function (Blueprint $table) {
            $table->dropMorphs('downloadable');
            $table->foreignId('soc_report_id')->constrained()->cascadeOnDelete();
        });
    }
};
