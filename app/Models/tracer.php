<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tracer extends Model
{
    /** @use HasFactory<\Database\Factories\TracerFactory> */
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'status',
        'tanggal_mulai',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
    ];

    /**
     * Get the alumni that owns the tracer.
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
