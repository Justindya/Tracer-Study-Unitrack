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
            $table->string('nim')->unique(); 
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('angkatan');
            
            $table->string('tahun_lulus')->nullable(); 
            
            $table->string('program_studi');
            
            $table->string('Foto')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat')->nullable(); 
            
            $table->string('pekerjaan_sekarang')->nullable(); 
            $table->text('skill')->nullable(); 
            
            $table->string('status_setelah_lulus')->nullable();
            $table->text('bio')->nullable();
            $table->string('linkedin')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};