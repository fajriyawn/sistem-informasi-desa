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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            
            // Kolom dari Grup 1 di Form
            $table->string('name');
            $table->string('phone');
            $table->string('email');

            // Kolom dari Grup 2 di Form
            $table->string('title');
            $table->string('type');

            // Kolom untuk Peta dan Lokasi
            $table->string('location_name')->nullable(); 
            $table->json('latitude')->nullable();
            $table->json('longitude')->nullable(); 

<<<<<<< HEAD
            $table->string('attachment')->nullable()->after('content');
=======
            $table->string('attachment')->nullable(); // Removed ->after('content')
>>>>>>> d1e372a (Update 23 Juli)

            // Kolom dari Rich Editor
            $table->text('content');

            $table->string('status')->default('Baru Masuk');
            $table->string('internal_notes')->nullable();

            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};