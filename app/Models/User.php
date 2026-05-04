<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'no_hp',
        'angkatan',
        'tahun_lulus',
        'program_studi',
        'jenis_kelamin',
        'alamat',
        'password',
        'role',
        'alumni_id'
        // 'status' dihapus karena status ada di tabel lokers & events, bukan di users
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the alumni/profil associated with the user.
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }

    /**
     * Get the events associated with the user (Partisipasi/Pendaftaran Event - Bawaan V3).
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'user_events');
    }

    /**
     * Get the events created/diajukan oleh user (Fitur baru untuk Alumni).
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * Get the lokers created/diajukan oleh user (Fitur baru untuk Alumni).
     */
    public function createdLokers()
    {
        return $this->hasMany(Loker::class, 'user_id');
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}