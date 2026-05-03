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
        Schema::table('alumnis', function (Blueprint $table) {
            if (!Schema::hasColumn('alumnis', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('alumnis', 'linkedin')) {
                $table->string('linkedin')->nullable();
            }
            // Just in case skill was missing too (some DBs might not have applied the latest version of previous migration)
            if (!Schema::hasColumn('alumnis', 'skill')) {
                $table->text('skill')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn(['bio', 'linkedin', 'skill']);
        });
    }
};
