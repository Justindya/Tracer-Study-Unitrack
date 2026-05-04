<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Admin Murni (Tanpa relasi ke tabel Alumni)
        User::create([
            'name' => 'Admin Utama',
            'nim' => 'admin123', // NIM dummy khusus admin
            'email' => 'admin@ush.ac.id',
            'password' => Hash::make('adminUSH!'), 
            'role' => 'admin',
            'alumni_id' => null, 
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ==========================================
        // 2. Membuat Data Dummy: MAHASISWA AKTIF
        // ==========================================
        $mahasiswaData = [
            ['nim' => '230101001', 'name' => 'Aditya Pratama', 'prodi' => 'Ilmu Komputer', 'angkatan' => '2023'],
            ['nim' => '230201002', 'name' => 'Bela Safitri', 'prodi' => 'Bisnis Digital', 'angkatan' => '2023'],
            ['nim' => '240301003', 'name' => 'Candra Wijaya', 'prodi' => 'Gizi', 'angkatan' => '2024'],
            ['nim' => '230101004', 'name' => 'Dinda Amelia', 'prodi' => 'Ilmu Komputer', 'angkatan' => '2023'],
            ['nim' => '240201005', 'name' => 'Eko Susanto', 'prodi' => 'Bisnis Digital', 'angkatan' => '2024'],
        ];

        foreach ($mahasiswaData as $mhs) {
            // Kita simpan biodatanya di tabel alumni (sebagai database profil)
            // Walaupun status aslinya masih mahasiswa aktif.
            $profilMhs = Alumni::create([
                'nama' => $mhs['name'],
                'nim' => $mhs['nim'],
                'email' => strtolower(str_replace(' ', '', $mhs['name'])) . '@mahasiswa.ush.ac.id',
                'angkatan' => $mhs['angkatan'],
                'tahun_lulus' => null, // Belum lulus
                'program_studi' => $mhs['prodi'],
                'no_hp' => '0812' . rand(10000000, 99999999),
                'jenis_kelamin' => rand(0, 1) ? 'laki-laki' : 'perempuan',
                // Kolom password di tabel alumni dihapus/dikosongkan karena login via tabel users
            ]);

            // Buat akun loginnya di tabel users
            User::create([
                'name' => $mhs['name'],
                'nim' => $mhs['nim'],
                'email' => $profilMhs->email,
                'no_hp' => $profilMhs->no_hp,
                'angkatan' => $mhs['angkatan'],
                'program_studi' => $mhs['prodi'],
                'jenis_kelamin' => $profilMhs->jenis_kelamin,
                'password' => Hash::make('ush' . $mhs['nim']), // ush + NIM
                'role' => 'mahasiswa', 
                'alumni_id' => $profilMhs->id,
                'email_verified_at' => now(),
            ]);
        }

        // ==========================================
        // 3. Membuat Data Dummy: ALUMNI RESMI
        // ==========================================
        $alumniData = [
            ['nim' => '190101001', 'name' => 'Fahri Gunawan', 'prodi' => 'Ilmu Komputer', 'angkatan' => '2019', 'lulus' => '2023'],
            ['nim' => '180201002', 'name' => 'Gita Kirana', 'prodi' => 'Bisnis Digital', 'angkatan' => '2018', 'lulus' => '2022'],
            ['nim' => '200301003', 'name' => 'Hadi Setiawan', 'prodi' => 'Gizi', 'angkatan' => '2020', 'lulus' => '2024'],
            ['nim' => '190101004', 'name' => 'Indah Permata', 'prodi' => 'Ilmu Komputer', 'angkatan' => '2019', 'lulus' => '2023'],
            ['nim' => '180201005', 'name' => 'Joko Riyadi', 'prodi' => 'Bisnis Digital', 'angkatan' => '2018', 'lulus' => '2022'],
        ];

        foreach ($alumniData as $alm) {
            $profilAlumni = Alumni::create([
                'nama' => $alm['name'],
                'nim' => $alm['nim'],
                'email' => strtolower(str_replace(' ', '', $alm['name'])) . '@alumni.ush.ac.id',
                'angkatan' => $alm['angkatan'],
                'tahun_lulus' => $alm['lulus'],
                'program_studi' => $alm['prodi'],
                'no_hp' => '0821' . rand(10000000, 99999999),
                'jenis_kelamin' => rand(0, 1) ? 'laki-laki' : 'perempuan',
            ]);

            User::create([
                'name' => $alm['name'],
                'nim' => $alm['nim'],
                'email' => $profilAlumni->email,
                'no_hp' => $profilAlumni->no_hp,
                'angkatan' => $alm['angkatan'],
                'tahun_lulus' => $alm['lulus'],
                'program_studi' => $alm['prodi'],
                'jenis_kelamin' => $profilAlumni->jenis_kelamin,
                'password' => Hash::make('ush' . $alm['nim']), // ush + NIM
                'role' => 'alumni', 
                'alumni_id' => $profilAlumni->id,
                'email_verified_at' => now(),
            ]);
        }

        // Panggilan ke Seeder lain dinonaktifkan sementara untuk menghindari error struktur lama
        // Jika Seeder ini sudah beres, baru kita perbaiki seeder Loker & Event.
        // $this->call([
        //     AlumniSeeder::class,
        //     TracerSeeder::class,
        //     LokerSeeder::class,
        //     EventSeeder::class,
        // ]);
    }
}