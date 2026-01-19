<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->unique(); // Tambah unique biar ga duplikat
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('angkatan');
            $table->string('tahun_lulus');
            $table->string('program_studi');
            $table->string('password');
            $table->string('Foto')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            
            // TAMBAHAN SESUAI LAPORAN & FITUR REKOMENDASI:
            $table->string('pekerjaan_sekarang')->nullable(); // Data Tracer
            $table->text('skill')->nullable(); // Untuk fitur Rekomendasi Karir (misal: "PHP, Desain, Excel")
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};