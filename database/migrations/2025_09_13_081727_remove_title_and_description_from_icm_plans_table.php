<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('icm_plans', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
    public function down(): void {
        Schema::table('icm_plans', function (Blueprint $table) {
            $table->string('title')->after('tahun');
            $table->text('description')->nullable()->after('title');
        });
    }
};
