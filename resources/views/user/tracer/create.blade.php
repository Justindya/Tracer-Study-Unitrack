@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-6">
            
            {{-- SIDEBAR KIRI --}}
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-xl shadow-sm p-5 text-center sticky top-24 border border-gray-100">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-600 text-2xl font-bold border-4 border-blue-50 shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }} 
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-xs mb-5">Mahasiswa / Alumni</p>

                    <div class="space-y-1 text-left">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-th-large w-4 text-center"></i> Overview
                        </a>
                        <a href="{{ route('user.tracer.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition bg-blue-600 text-white shadow-md shadow-blue-200">
                            <i class="fas fa-edit w-4 text-center"></i> Data Tracer
                        </a>
                        <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-file-alt w-4 text-center"></i> Lamaran Saya
                        </a>
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-bookmark w-4 text-center"></i> Bookmark
                        </a>
                    </div>
                </div>
            </div>

            {{-- KONTEN KANAN --}}
            <div class="w-full md:w-3/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h1 class="text-2xl font-bold text-gray-900">Kuesioner Tracer Study</h1>
                        <p class="text-sm text-gray-500 mt-1">Isi data sesuai dengan kondisi Anda saat ini.</p>
                    </div>

                    <form action="{{ route('user.tracer.store') }}" method="POST">
                        @csrf
                        
                        {{-- STEP 1: Status Utama --}}
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Status Pekerjaan Saat Ini</label>
                            <select id="status_selector" name="status" class="w-full border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required onchange="toggleForm()">
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="bekerja">Bekerja (Full Time/Part Time)</option>
                                <option value="wiraswasta">Wiraswasta / Memiliki Usaha</option>
                                <option value="melanjutkan_pendidikan">Melanjutkan Pendidikan</option>
                                <option value="tidak_bekerja">Sedang Mencari Pekerjaan</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai (Status Ini)</label>
                            <input type="date" name="tanggal_mulai" class="w-full border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        </div>

                        {{-- STEP 2: Form Dinamis --}}
                        <div id="dynamic_forms" class="p-6 bg-gray-50 rounded-xl border border-gray-100 hidden">
                            
                            {{-- FORM A: BEKERJA --}}
                            <div id="form_bekerja" class="form-section hidden space-y-4">
                                <h3 class="font-bold text-blue-600 border-b pb-2 mb-4">Detail Pekerjaan</h3>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Nama Perusahaan / Instansi</label>
                                    <input type="text" name="soal_1" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Contoh: PT. Tokopedia">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Jabatan / Posisi</label>
                                    <input type="text" name="soal_2" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Contoh: Backend Developer">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Pendapatan / Gaji Bulanan (Rupiah)</label>
                                    <input type="number" name="soal_3" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Contoh: 5000000">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Kesesuaian Bidang Studi</label>
                                    <select name="soal_4" class="w-full rounded-lg border-gray-300 mt-1">
                                        <option value="Sangat Sesuai">Sangat Sesuai</option>
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Kurang Sesuai">Kurang Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>

                            {{-- FORM B: WIRASWASTA --}}
                            <div id="form_wiraswasta" class="form-section hidden space-y-4">
                                <h3 class="font-bold text-green-600 border-b pb-2 mb-4">Detail Usaha</h3>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Nama Usaha / Bisnis</label>
                                    <input type="text" name="soal_1" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Contoh: Kopi Senja">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Bidang Usaha</label>
                                    <input type="text" name="soal_2" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Contoh: Kuliner / Fashion">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Omset Rata-rata per Bulan</label>
                                    <input type="number" name="soal_3" class="w-full rounded-lg border-gray-300 mt-1" placeholder="Nominal Rupiah">
                                </div>
                            </div>

                            {{-- FORM C: PENDIDIKAN --}}
                            <div id="form_pendidikan" class="form-section hidden space-y-4">
                                <h3 class="font-bold text-purple-600 border-b pb-2 mb-4">Detail Studi Lanjut</h3>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Nama Universitas / Kampus</label>
                                    <input type="text" name="soal_1" class="w-full rounded-lg border-gray-300 mt-1">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Program Studi / Jurusan</label>
                                    <input type="text" name="soal_2" class="w-full rounded-lg border-gray-300 mt-1">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500">Jenjang</label>
                                    <select name="soal_3" class="w-full rounded-lg border-gray-300 mt-1">
                                        <option value="S2">S2 (Magister)</option>
                                        <option value="S3">S3 (Doktor)</option>
                                        <option value="Profesi">Pendidikan Profesi</option>
                                    </select>
                                </div>
                            </div>

                            {{-- FORM D: TIDAK BEKERJA --}}
                            <div id="form_tidak_bekerja" class="form-section hidden space-y-4">
                                <div class="p-4 bg-yellow-50 text-yellow-700 rounded-lg text-sm">
                                    <i class="fas fa-info-circle mr-2"></i> Mohon tetap semangat! Kami akan memberikan rekomendasi lowongan kerja yang sesuai untuk Anda.
                                </div>
                                <input type="hidden" name="soal_1" value="-">
                                <input type="hidden" name="soal_2" value="-">
                                <input type="hidden" name="soal_3" value="-">
                            </div>

                        </div>

                        <div class="mt-8 pt-4 border-t border-gray-50 text-right">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-blue-200 transform hover:-translate-y-1">
                                Simpan Data Tracer
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleForm() {
        const status = document.getElementById('status_selector').value;
        const container = document.getElementById('dynamic_forms');
        const sections = document.querySelectorAll('.form-section');
        
        sections.forEach(section => {
            section.classList.add('hidden');
            const inputs = section.querySelectorAll('input, select');
            inputs.forEach(input => input.disabled = true);
        });

        container.classList.remove('hidden');

        let activeSectionId = '';
        if (status === 'bekerja') activeSectionId = 'form_bekerja';
        else if (status === 'wiraswasta') activeSectionId = 'form_wiraswasta';
        else if (status === 'melanjutkan_pendidikan') activeSectionId = 'form_pendidikan';
        else if (status === 'tidak_bekerja') activeSectionId = 'form_tidak_bekerja';

        if (activeSectionId) {
            const activeSection = document.getElementById(activeSectionId);
            activeSection.classList.remove('hidden');
            const activeInputs = activeSection.querySelectorAll('input, select');
            activeInputs.forEach(input => input.disabled = false); 
        }
    }
</script>
@endsection