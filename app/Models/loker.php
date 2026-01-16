<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    /** @use HasFactory<\Database\Factories\LokerFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'perusahaan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'kontak'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
