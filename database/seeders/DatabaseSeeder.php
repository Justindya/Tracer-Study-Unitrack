<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumni;
use App\Models\loker;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin
        $admin = User::create([
            'name' => 'Admin Utama',
            'nim' => 'admin123', 
            'email' => 'admin@ush.ac.id',
            'password' => Hash::make('adminUSH!'), 
            'role' => 'admin',
            'alumni_id' => null, 
            'email_verified_at' => now(),
        ]);

        // 2. MAHASISWA AKTIF 
        $mahasiswaData = [
            ['nim' => '062301004', 'name' => 'AMRI KHOIRUDIN IRFANDI WITJAKSONO', 'hp' => '0895800129924', 'jk' => 'laki-laki'],
            ['nim' => '062301006', 'name' => 'GABRIEL', 'hp' => '087851940753', 'jk' => 'laki-laki'],
            ['nim' => '062301012', 'name' => 'TROY EGBERT EVERS', 'hp' => '081328972073', 'jk' => 'laki-laki'],
            ['nim' => '062301013', 'name' => 'INDY NINDA', 'hp' => '088983628978', 'jk' => 'perempuan'],
            ['nim' => '062301031', 'name' => 'CINDY NINDA ', 'hp' => '08982188488', 'jk' => 'perempuan'], 
        ];

        foreach ($mahasiswaData as $mhs) {
            $profilMhs = Alumni::create([
                'nama' => $mhs['name'],
                'nim' => $mhs['nim'],
                'email' => strtolower(str_replace(' ', '', explode(' ', $mhs['name'])[0])) . $mhs['nim'] . '@mahasiswa.ush.ac.id', 
                'angkatan' => '2023',
                'tahun_lulus' => null, 
                'program_studi' => 'Ilmu Komputer',
                'no_hp' => $mhs['hp'],
                'jenis_kelamin' => $mhs['jk'],
                'skill' => 'HTML, CSS, JavaScript, MySQL', 
            ]);

            User::create([
                'name' => $mhs['name'],
                'nim' => $mhs['nim'],
                'email' => $profilMhs->email,
                'no_hp' => $profilMhs->no_hp,
                'angkatan' => '2023',
                'program_studi' => 'Ilmu Komputer',
                'jenis_kelamin' => $profilMhs->jenis_kelamin,
                'password' => Hash::make('ush' . $mhs['nim']), 
                'role' => 'mahasiswa', 
                'alumni_id' => $profilMhs->id,
                'email_verified_at' => now(),
            ]);
        }

        // 3. ALUMNI RESMI 
        $alumniData = [
            ['nim' => '062101001', 'name' => 'OSVALDO FERNANDY WIJAYA', 'email' => 'osvaldoofw@gmail.com', 'hp' => '+6282134949311', 'jk' => 'laki-laki'],
            ['nim' => '062101002', 'name' => 'AHMAD DAVID WAHYUDI', 'email' => 'davidcreativeat93@gmail.com', 'hp' => '+6281390807565', 'jk' => 'laki-laki'],
            ['nim' => '062101004', 'name' => 'WIDYA KARISMA ARI RAHMAWATI', 'email' => 'widyakaris15@gmail.com', 'hp' => '+6285643974415', 'jk' => 'perempuan'],
            ['nim' => '062101012', 'name' => 'FIRMAN WIDODO', 'email' => 'frmnvv13@gmail.com', 'hp' => '+6285888666514', 'jk' => 'laki-laki'],
            ['nim' => '062101005', 'name' => 'BILAL SETYA PAMBUDI', 'email' => 'bilalpambudi123@gmail.com', 'hp' => '+6285745646763', 'jk' => 'laki-laki'],
        ];

        foreach ($alumniData as $alm) {
            $profilAlumni = Alumni::create([
                'nama' => $alm['name'],
                'nim' => $alm['nim'],
                'email' => $alm['email'],
                'angkatan' => '2021',
                'tahun_lulus' => '2025',
                'program_studi' => 'Ilmu Komputer',
                'no_hp' => $alm['hp'],
                'jenis_kelamin' => $alm['jk'],
                'skill' => 'PHP, Laravel, Networking, Database', 
            ]);

            User::create([
                'name' => $alm['name'],
                'nim' => $alm['nim'],
                'email' => $profilAlumni->email,
                'no_hp' => $profilAlumni->no_hp,
                'angkatan' => '2021',
                'tahun_lulus' => '2025',
                'program_studi' => 'Ilmu Komputer',
                'jenis_kelamin' => $profilAlumni->jenis_kelamin,
                'password' => Hash::make('ush' . $alm['nim']), 
                'role' => 'alumni', 
                'alumni_id' => $profilAlumni->id,
                'email_verified_at' => now(),
            ]);
        }

        // 4. LOKER (Approved)
        loker::create([
            'user_id' => $admin->id,
            'judul' => 'Computer User Support',
            'perusahaan' => 'PT Djarum',
            'lokasi' => 'Jakarta, Kudus, Surabaya, Bandung, Semarang',
            'tanggal_mulai' => Carbon::now(),
            'tanggal_selesai' => Carbon::now()->addMonths(1),
            'deskripsi' => "Mari bergabung bersama PT Djarum sebagai Computer User Support.\n\nPersyaratan:\n- S1 Teknologi Informasi dengan minimal IPK 3.00.\n- Menguasai pemanfaatan platform PC dan aplikasinya terutama Windows dan MS Office.\n- Menguasai beberapa konfigurasi dasar hardware, LAN dan WAN.\n- Memiliki kemampuan Windows scripting dan teknik programming dasar.\n- Bersedia ditempatkan di Jakarta, Kudus, Surabaya, Bandung dan Semarang.\n\nProses rekrutmen tidak dipungut biaya apa pun.",
            'kontak' => 'www.djarum.com (Halaman Career)',
            'status' => 'approved'
        ]);

        // 5. EVENT (Approved)
        Event::create([
            'user_id' => $admin->id,
            'judul' => 'Joint Semiconductor Training: Danantara x Arm',
            'tempat' => 'Menara Mandiri Lt. 9, Jl. Jenderal Sudirman, Jakarta',
            'tanggal' => '2026-05-20',
            'jam' => '08:00:00',
            'deskripsi' => "Bangun Masa Depanmu di Industri Chip Tingkat Dunia dengan Kerjasama Danantara dan Arm Inc.\n\nIndustri semikonduktor menjadi fondasi bagi berbagai teknologi masa depan. Program ini memberikan kesempatan untuk belajar langsung dari praktisi global.\n\nApa yang akan dipelajari?\n- Kurikulum & pelatihan langsung dari engineer Arm\n- Akses ke platform pelatihan on-demand Arm\n- Insight & peluang karier di industri semikonduktor\n\nPendaftaran dibuka hingga 3 Mei 2026 melalui: https://bit.ly/PelatihanARM",
            'status' => 'approved'
        ]);

        Event::create([
            'user_id' => $admin->id,
            'judul' => 'When Conflict Becomes a Business Problem',
            'tempat' => 'Zoom (Online)',
            'tanggal' => '2026-05-19',
            'jam' => '10:00:00',
            'deskripsi' => "UNIVERSITAS SUGENG HARTONO International WEBINAR\n\nTopik: International Humanitarian Law, Human Rights, and the Legal Risks of Operating in Volatile Markets.\n\nSpeaker:\n1. Maranatha L. H.F., S.H., M.H. (Lecturer of Universitas Sugeng Hartono)\n2. Fauve Kurnadi, LL.M. (Senior Advisor at TrustWorks Global)\n\nLink Registrasi: s.id/InternationalWebinarUSH26",
            'status' => 'approved'
        ]);
    }
}