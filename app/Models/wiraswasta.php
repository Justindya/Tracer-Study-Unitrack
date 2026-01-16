<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wiraswasta extends Model
{
    /** @use HasFactory<\Database\Factories\WiraswastaFactory> */
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'soal_1',
        'soal_2',
        'soal_3',
        'soal_4',
        'soal_5',
    ];

    public function alumni()
    {
        return $this->belongsTo(\App\Models\alumni::class);
    }
}
