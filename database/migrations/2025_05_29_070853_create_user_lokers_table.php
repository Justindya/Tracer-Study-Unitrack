<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_lokers', function (Blueprint $table) {
            $table->id();
            // Menyimpan siapa yang melamar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menyimpan loker apa yang dilamar
            $table->foreignId('loker_id')->constrained()->onDelete('cascade');
            
            // TAMBAHAN PENTING: Status Lamaran
            // Default 'terkirim' saat user klik tombol Lamar
            $table->enum('status', ['terkirim', 'diproses', 'diterima', 'ditolak'])->default('terkirim');
            
            $table->timestamps(); // Mencatat kapan melamar (created_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_lokers');
    }
};