<?php

namespace Database\Seeders;

use App\Models\Event; // Pastikan Model Event diimport
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'judul' => 'Job Fair Kampus 2026',
                'kategori' => 'Job Fair', // Pastikan kolom ini ada di migration, atau masukkan ke deskripsi jika tidak
                'tempat' => 'Auditorium Utama',
                'tanggal' => now()->addWeeks(2), // 2 minggu lagi
                'jam' => '09:00',
                'deskripsi' => 'Temukan karir impianmu! Dihadiri oleh 50+ perusahaan multinasional dan startup unicorn. Jangan lupa bawa CV cetak dan softcopy.',
            ],
            [
                'judul' => 'Webinar: Tips Lolos BUMN',
                'kategori' => 'Webinar',
                'tempat' => 'Online (Zoom)',
                'tanggal' => now()->addDays(5),
                'jam' => '13:00',
                'deskripsi' => 'Kupas tuntas strategi menembus seleksi BUMN bersama praktisi HRD. Pelajari trik psikotes dan wawancara user.',
            ],
            [
                'judul' => 'Workshop: Basic Python for Data Science',
                'kategori' => 'Workshop',
                'tempat' => 'Lab Komputer 3',
                'tanggal' => now()->addWeeks(1),
                'jam' => '10:00',
                'deskripsi' => 'Pelatihan dasar pemrograman Python untuk pengolahan data. Wajib membawa laptop masing-masing. Sertifikat tersedia.',
            ],
            [
                'judul' => 'Seminar Nasional: Masa Depan AI',
                'kategori' => 'Seminar',
                'tempat' => 'Aula Fakultas Teknik',
                'tanggal' => now()->addMonth(1),
                'jam' => '08:30',
                'deskripsi' => 'Diskusi panel mengenai dampak Artificial Intelligence terhadap dunia kerja di masa depan. Pembicara dari industri teknologi terkemuka.',
            ],
            [
                'judul' => 'Alumni Gathering & Networking',
                'kategori' => 'Networking',
                'tempat' => 'Hotel Grand Asia',
                'tanggal' => now()->addMonth(2),
                'jam' => '18:00',
                'deskripsi' => 'Malam keakraban alumni lintas angkatan. Perluas relasi profesionalmu sambil bernostalgia masa kuliah.',
            ],
            [
                'judul' => 'CV & LinkedIn Review Session',
                'kategori' => 'Workshop',
                'tempat' => 'Ruang Seminar Perpustakaan',
                'tanggal' => now()->addDays(10),
                'jam' => '14:00',
                'deskripsi' => 'Bedah CV dan profil LinkedIn kamu agar dilirik rekruter. Bimbingan langsung one-on-one dengan konsultan karir.',
            ],
        ];

        // Loop untuk insert data
        foreach ($events as $e) {
            // Cek apakah kolom 'kategori' ada di tabel events kamu. 
            // Jika TIDAK ADA, hapus baris 'kategori' => ... di bawah ini.
            Event::create([
                'judul' => $e['judul'],
                'tempat' => $e['tempat'],
                'tanggal' => $e['tanggal'],
                'jam' => $e['jam'],
                'deskripsi' => $e['deskripsi'], 
                // 'kategori' => $e['kategori'], // Uncomment jika tabelmu punya kolom kategori
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}