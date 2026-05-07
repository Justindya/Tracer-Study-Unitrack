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
        Schema::table('lokers', function (Blueprint $table) {
            $table->string('posisi')->nullable()->change();
            $table->string('jenis_perusahaan')->nullable()->change();
            $table->string('email_perusahaan')->nullable()->change();
            $table->integer('jumlah_dibutuhkan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokers', function (Blueprint $table) {
            $table->string('posisi')->nullable(false)->change();
            $table->string('jenis_perusahaan')->nullable(false)->change();
            $table->string('email_perusahaan')->nullable(false)->change();
            $table->integer('jumlah_dibutuhkan')->nullable(false)->change();
        });
    }
};
