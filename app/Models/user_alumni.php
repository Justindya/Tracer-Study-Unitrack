<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_alumni extends Model
{
    /** @use HasFactory<\Database\Factories\UserAlumniFactory> */
    use HasFactory;

    /**
     * Define the relationship with the Alumni model.
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}
