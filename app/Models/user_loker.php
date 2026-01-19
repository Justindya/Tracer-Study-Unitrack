<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_loker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loker()
    {
        return $this->belongsTo(loker::class, 'loker_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}