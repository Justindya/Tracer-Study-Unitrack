<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tidak_bekerja extends Model
{
    /** @use HasFactory<\Database\Factories\TidakBekerjaFactory> */
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'soal_1',
        'soal_2',
        'soal_3',
    ];

    public function alumni()
    {
        return $this->belongsTo(\App\Models\alumni::class);
    }
}
