<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tracer;
use App\Models\Alumni;

class TracerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa alumni untuk membuat data tracer
        $alumniIds = Alumni::pluck('id')->toArray();

        // Data sample tracer (hanya untuk beberapa alumni)
        // $tracerData = [
        //     [
        //         'alumni_id' => $alumniIds[0] ?? 1, // Ahmad Rizki (laki-laki)
        //         'mulai_kerja' => '2025-06-01',
        //         'nama_instansi' => 'PT. Tech Solutions',
        //         'jabatan' => 'Software Developer',
        //         'kesesuaian_kerja' => 'Sesuai',
        //         'kelurahan' => 'Kebayoran Baru',
        //         'kab_kota' => 'Jakarta Selatan',
        //         'provinsi' => 'DKI Jakarta',
        //         'kode_pos' => '12120',
        //         'tgl_update' => now()
        //     ],
        //     [
        //         'alumni_id' => $alumniIds[1] ?? 2, // Siti Nurhaliza (perempuan)
        //         'mulai_kerja' => '2025-06-15',
        //         'nama_instansi' => 'PT. Digital Innovation',
        //         'jabatan' => 'UI/UX Designer',
        //         'kesesuaian_kerja' => 'Sesuai',
        //         'kelurahan' => 'Menteng',
        //         'kab_kota' => 'Jakarta Pusat',
        //         'provinsi' => 'DKI Jakarta',
        //         'kode_pos' => '10310',
        //         'tgl_update' => now()
        //     ],
        //     [
        //         'alumni_id' => $alumniIds[2] ?? 3, // Budi Santoso (laki-laki)
        //         'mulai_kerja' => '2025-07-01',
        //         'nama_instansi' => 'PT. Data Analytics',
        //         'jabatan' => 'Data Analyst',
        //         'kesesuaian_kerja' => 'Sesuai',
        //         'kelurahan' => 'Grogol',
        //         'kab_kota' => 'Jakarta Barat',
        //         'provinsi' => 'DKI Jakarta',
        //         'kode_pos' => '11450',
        //         'tgl_update' => now()
        //     ],
        //     [
        //         'alumni_id' => $alumniIds[3] ?? 4, // Dewi Sartika (perempuan)
        //         'mulai_kerja' => '2025-07-15',
        //         'nama_instansi' => 'PT. Web Development',
        //         'jabatan' => 'Frontend Developer',
        //         'kesesuaian_kerja' => 'Sesuai',
        //         'kelurahan' => 'Jatinegara',
        //         'kab_kota' => 'Jakarta Timur',
        //         'provinsi' => 'DKI Jakarta',
        //         'kode_pos' => '13310',
        //         'tgl_update' => now()
        //     ]
        // ];

        // foreach ($tracerData as $data) {
        //     Tracer::create($data);
        // }
    }
}
