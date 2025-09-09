<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Ganti nama kolom 'location_name' menjadi 'address_detail'
            $table->renameColumn('location_name', 'address_detail');

            // Tambahkan kolom baru untuk nama kabupaten/kota
            $table->string('city_name')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('address_detail', 'location_name');
            $table->dropColumn('city_name');
        });
    }
};
