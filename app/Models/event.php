<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'tempat',
        'tanggal',
        'jam',
        'deskripsi'
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
