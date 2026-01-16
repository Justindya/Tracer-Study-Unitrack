<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kusioner extends Model
{
    /** @use HasFactory<\Database\Factories\KusionerFactory> */
    use HasFactory;
    protected $fillable = [
        'soal',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d'
    ];

    // di model Kusioner.php
    public function userKusioners()
    {
        return $this->hasMany(user_kusioner::class);
    }

    public function jawabans()
    {
        return $this->hasMany(KusionerJawaban::class);
    }
}
