<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama penanggung jawab
            $table->string('email');
            $table->string('phone');
            $table->string('organization_name'); // Nama instansi/sekolah/kelompok
            $table->integer('participant_count'); // Jumlah peserta
            $table->string('training_topic'); // Topik pelatihan yang dipilih
            $table->date('proposed_date'); // Usulan tanggal pelaksanaan
            $table->text('message')->nullable(); // Pesan tambahan
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_registrations');
    }
};
