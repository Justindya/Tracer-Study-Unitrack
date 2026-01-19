<?php

namespace Database\Seeders;

use App\Models\loker;
use Illuminate\Database\Seeder;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokers = [
            // --- KATEGORI IT (DOMINAN) ---
            [
                'judul' => 'Full Stack Developer (Laravel + Vue)',
                'perusahaan' => 'PT. Inovasi Teknologi Nusantara',
                'lokasi' => 'Jakarta Selatan',
                'deskripsi' => "Mencari developer yang menguasai ekosistem Laravel untuk membangun aplikasi web skala besar.
                                <br><br><b>Tipe Pekerjaan:</b> Full Time
                                <br><b>Skill & Requirements:</b>
                                <ul>
                                    <li>Mahir PHP, Laravel, dan Vue.js/React.</li>
                                    <li>Paham Database MySQL dan REST API.</li>
                                    <li>Berpengalaman menggunakan Git.</li>
                                </ul>",
                'kontak' => 'hrd@inovasitech.id | 0812-3456-7890',
            ],
            [
                'judul' => 'Mobile App Developer (Flutter)',
                'perusahaan' => 'Appify Studio Indonesia',
                'lokasi' => 'Bandung',
                'deskripsi' => "Kesempatan magang bagi mahasiswa IT yang ingin mendalami pengembangan aplikasi mobile.
                                <br><br><b>Tipe Pekerjaan:</b> Internship
                                <br><b>Kualifikasi:</b>
                                <ul>
                                    <li>Memahami dasar bahasa Dart dan Framework Flutter.</li>
                                    <li>Pernah membuat satu aplikasi mobile sederhana.</li>
                                    <li>Memiliki laptop sendiri.</li>
                                </ul>",
                'kontak' => 'intern@appify.co.id | 0857-1234-5678',
            ],
            [
                'judul' => 'UI/UX Designer (Web & App)',
                'perusahaan' => 'Creative Digital Agency',
                'lokasi' => 'Remote (Work From Anywhere)',
                'deskripsi' => "Dicari desainer kreatif untuk merancang antarmuka aplikasi yang user-friendly.
                                <br><br><b>Tipe Pekerjaan:</b> Remote
                                <br><b>Skill yang dibutuhkan:</b>
                                <ul>
                                    <li>Mahir menggunakan Figma dan Adobe XD.</li>
                                    <li>Memiliki portofolio desain UI yang menarik.</li>
                                    <li>Paham prinsip User Experience (UX).</li>
                                </ul>",
                'kontak' => 'talent@creativeagency.com | 0811-2233-4455',
            ],
            [
                'judul' => 'IT Support & Network Admin',
                'perusahaan' => 'Rumah Sakit Sehat Sentosa',
                'lokasi' => 'Surakarta',
                'deskripsi' => "Menangani troubleshooting hardware, instalasi software, dan jaringan internet rumah sakit.
                                <br><br><b>Tipe Pekerjaan:</b> Full Time
                                <br><b>Persyaratan:</b>
                                <ul>
                                    <li>Lulusan D3/S1 Teknik Komputer/Informatika.</li>
                                    <li>Paham Mikrotik dan troubleshooting LAN/WLAN.</li>
                                    <li>Bersedia bekerja shift.</li>
                                </ul>",
                'kontak' => 'it@rssentosa.com | 0821-9988-7766',
            ],
            [
                'judul' => 'Junior Data Analyst',
                'perusahaan' => 'Fintech Solusi Cerdas',
                'lokasi' => 'Yogyakarta',
                'deskripsi' => "Membantu tim data mengolah data transaksi harian.
                                <br><br><b>Tipe Pekerjaan:</b> Part Time
                                <br><b>Keahlian:</b>
                                <ul>
                                    <li>Menguasai SQL dan Excel (Advanced).</li>
                                    <li>Familiar dengan Python atau R dasar.</li>
                                    <li>Teliti dan analitis.</li>
                                </ul>",
                'kontak' => 'data@fintechsolusi.id | 0813-4567-8910',
            ],

            // --- KATEGORI BISNIS DIGITAL & MANAJEMEN ---
            [
                'judul' => 'Digital Marketing Specialist',
                'perusahaan' => 'E-Commerce Laris Manis',
                'lokasi' => 'Tangerang',
                'deskripsi' => "Mengelola kampanye iklan dan media sosial perusahaan. Cocok untuk prodi Bisnis Digital.
                                <br><br><b>Tipe Pekerjaan:</b> Full Time
                                <br><b>Skill:</b>
                                <ul>
                                    <li>Paham SEO/SEM dan Google Analytics.</li>
                                    <li>Bisa menjalankan Facebook & Instagram Ads.</li>
                                    <li>Copywriting yang menarik.</li>
                                </ul>",
                'kontak' => 'marketing@larismanis.com | 0877-6655-4433',
            ],
            [
                'judul' => 'Business Development Officer',
                'perusahaan' => 'PT. Global Ekspor Impor',
                'lokasi' => 'Surabaya',
                'deskripsi' => "Mengembangkan strategi bisnis internasional dan menjalin kerjasama dengan mitra luar negeri.
                                <br><br><b>Tipe Pekerjaan:</b> Full Time
                                <br><b>Persyaratan:</b>
                                <ul>
                                    <li>Lulusan Manajemen Bisnis Internasional/Manajemen.</li>
                                    <li>Fasih berbahasa Inggris (Lisan & Tulis).</li>
                                    <li>Memiliki kemampuan negosiasi yang baik.</li>
                                </ul>",
                'kontak' => 'hrd@globalekspor.co.id | 0812-9876-5432',
            ],

            // --- KATEGORI GIZI & PANGAN ---
            [
                'judul' => 'Quality Control Staff (Food)',
                'perusahaan' => 'PT. Indofood Makmur',
                'lokasi' => 'Semarang',
                'deskripsi' => "Memastikan kualitas produk makanan sesuai standar keamanan pangan.
                                <br><br><b>Tipe Pekerjaan:</b> Full Time
                                <br><b>Kualifikasi:</b>
                                <ul>
                                    <li>Lulusan Teknologi Pangan atau Ilmu Gizi.</li>
                                    <li>Paham HACCP dan GMP.</li>
                                    <li>Teliti dan disiplin dalam bekerja.</li>
                                </ul>",
                'kontak' => 'recruitment@indofoodmakmur.com | 0856-7890-1234',
            ],

            // --- KATEGORI HUKUM BISNIS ---
            [
                'judul' => 'Legal Staff Intern',
                'perusahaan' => 'Law Firm Sudirman & Partners',
                'lokasi' => 'Jakarta Pusat',
                'deskripsi' => "Membantu penyusunan kontrak bisnis dan dokumen legal perusahaan.
                                <br><br><b>Tipe Pekerjaan:</b> Internship
                                <br><b>Syarat:</b>
                                <ul>
                                    <li>Mahasiswa tingkat akhir Hukum Bisnis/Hukum.</li>
                                    <li>Paham hukum perdata dan dagang.</li>
                                    <li>Kemampuan drafting legal contract yang baik.</li>
                                </ul>",
                'kontak' => 'intern@sudirmanlaw.com | 0811-1122-3344',
            ],
        ];

        foreach ($lokers as $loker) {
            loker::create([
                'judul' => $loker['judul'],
                'perusahaan' => $loker['perusahaan'],
                'lokasi' => $loker['lokasi'],
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(2),
                'deskripsi' => $loker['deskripsi'],
                'kontak' => $loker['kontak'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}