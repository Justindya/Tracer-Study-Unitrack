<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'tema',
        'tempat',
        'tanggal',
        'jam',
        'deskripsi',
        'is_paid',
        'harga',
        'pembicara',
        'poster',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function userEvents()
    {
        return $this->hasMany(user_event::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'user_events');
    }
}
