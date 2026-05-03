<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loker extends Model
{
    /** @use HasFactory<\Database\Factories\LokerFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'posisi',
        'perusahaan',
        'jenis_perusahaan',
        'email_perusahaan',
        'jumlah_dibutuhkan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'poster',
        'status',
        'kontak'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}
