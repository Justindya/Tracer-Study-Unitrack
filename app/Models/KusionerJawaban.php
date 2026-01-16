<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KusionerJawaban extends Model
{
    use HasFactory;

    protected $table = 'kusioner_jawabans';

    protected $fillable = [
        'user_id',
        'kusioner_id',
        'jawaban'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kusioner()
    {
        return $this->belongsTo(Kusioner::class);
    }
}
