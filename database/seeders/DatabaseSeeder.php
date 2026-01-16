<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminAlumni = Alumni::create([
            'nama' => 'Admin Sistem',
            'nim' => '12345678',
            'email' => 'admin@example.com',
            'angkatan' => '2020',
            'tahun_lulus' => '2024',
            'program_studi' => 'Sistem Informasi',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh Admin No. 123',
            'jenis_kelamin' => 'laki-laki',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Admin Sistem',
            'nim' => '12345678',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'alumni_id' => $adminAlumni->id,
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Run other seeders
        $this->call([
            AlumniSeeder::class,
            TracerSeeder::class,
            LokerSeeder::class,
            EventSeeder::class,
        ]);
    }
}
