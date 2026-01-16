<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_kusioner extends Model
{
    /** @use HasFactory<\Database\Factories\UserKusionerFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kusioner_id',
        'status',
    ];

    // di model user_kusioner.php
    public function kusioner()
    {
        return $this->belongsTo(Kusioner::class);
    }
}
