<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    /** @use HasFactory<\Database\Factories\AlumniFactory> */
    use HasFactory;

    protected $table = 'alumnis';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'no_hp',
        'angkatan',
        'tahun_lulus',
        'program_studi',
        'password',
        'Foto',
        'jenis_kelamin',
        'alamat',
        'status_setelah_lulus'
    ];

    /**
     * Get the tracers for the alumni.
     */
    public function tracers()
    {
        return $this->hasMany(tracer::class);
    }

    public function bekerja()
    {
        return $this->hasOne(\App\Models\bekerja::class);
    }
    public function wiraswasta()
    {
        return $this->hasOne(\App\Models\wiraswasta::class);
    }
    public function melanjutkanPendidikan()
    {
        return $this->hasOne(\App\Models\melanjutkan_pendidikan::class);
    }
    public function tidakBekerja()
    {
        return $this->hasOne(\App\Models\tidak_bekerja::class);
    }
}
