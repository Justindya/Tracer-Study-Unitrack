@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- SIDEBAR KIRI --}}
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center sticky top-24">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full p-[3px] shadow-md">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                                @if(Auth::user()->alumni && Auth::user()->alumni->Foto)
                                    <img src="{{ asset('storage/' . Auth::user()->alumni->Foto) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-3xl font-black text-gray-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h2 class="text-lg font-bold text-gray-900 truncate px-2">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-xs mb-6 font-medium tracking-wide">Mahasiswa / Alumni</p>

                    <nav class="space-y-2 text-left">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-home w-5 text-center"></i> Overview
                        </a>
                        {{-- MENU AKTIF --}}
                        <a href="{{ route('user.tracer.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            {{-- KONTEN KANAN --}}
            <div class="w-full lg:w-3/4 space-y-6">
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-8">
                    
                    {{-- HEADER DIRAPIKAN --}}
                    <div class="pb-3 border-b border-gray-200 mb-6">
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Tambah Data Tracer</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Lengkapi data karir Anda untuk database alumni.</p>
                    </div>

                    <form action="{{ route('user.tracer.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-5">
                            <label for="status" class="block text-gray-800 text-sm font-bold mb-2">Status Saat Ini</label>
                            <div class="relative">
                                <select name="status" id="status" class="w-full px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none bg-white appearance-none transition cursor-pointer" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="bekerja" {{ old('status') == 'bekerja' ? 'selected' : '' }}>Bekerja (Full Time/Part Time)</option>
                                    <option value="wiraswasta" {{ old('status') == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta / Memiliki Usaha</option>
                                    <option value="melanjutkan_pendidikan" {{ old('status') == 'melanjutkan_pendidikan' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
                                    <option value="tidak_bekerja" {{ old('status') == 'tidak_bekerja' ? 'selected' : '' }}>Sedang Mencari Pekerjaan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="tanggal_mulai" class="block text-gray-800 text-sm font-bold mb-2">Tanggal Mulai (Status Ini)</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                                   class="w-full px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"
                                   value="{{ old('tanggal_mulai') }}" required>
                        </div>

                        <div id="soal-form" class="space-y-4 mt-6"></div>

                        {{-- TOMBOL AKSI BAWAH --}}
                        <div class="mt-8 flex flex-col sm:flex-row items-center pt-5 border-t border-gray-100 gap-3 justify-end">
                            <a href="{{ route('user.tracer.index') }}" class="w-full sm:w-auto bg-white border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-gray-50 transition shadow-sm text-center">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold text-sm transition shadow-sm flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const statusQuestions = {
        'bekerja': [
            'Berapa lama anda mendapatkan pekerjaan?',
            'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)?',
            'Lokasi Tempat Anda Bekerja (Provinsi)',
            'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
            'Jenis Perusahaan tempat anda bekerja',
            'Nama Perusahaan tempat anda bekerja',
            'Kategori perusahaan tempat anda bekerja',
            'Informasi yang anda dapatkan untuk mencari pekerjaan'
        ],
        'wiraswasta': [
            'Apakah jabatan/posisi anda ketika Berwirausaha?',
            'Nama Usaha anda',
            'Pendapatan per bulan anda',
            'Bidang Usaha',
            'Berapa lama anda memulai usaha?'
        ],
        'melanjutkan_pendidikan': [
            'Jenjang melanjutkan',
            'Nama Perguruan Tinggi',
            'Nama Program Studi',
            'Tanggal Bulan Tahun Masuk',
            'Sumber Biaya'
        ],
        'tidak_bekerja': [
            'Berapa perusahaan/instansi yang sudah anda lamar?',
            'Berapa banyak respons lamaran anda?',
            'Berapa banyak undangan wawancara?'
        ]
    };

    function renderSoal(status, values = {}) {
        const container = document.getElementById('soal-form');
        container.innerHTML = '';

        let normalizedStatus = status;
        if(status === 'melanjutkan') normalizedStatus = 'melanjutkan_pendidikan';
        if(status === 'tidak bekerja') normalizedStatus = 'tidak_bekerja';

        if (!normalizedStatus || !statusQuestions[normalizedStatus]) return;

        let headerText = '';
        let headerColor = '';
        if (normalizedStatus === 'bekerja') { headerText = 'Detail Pekerjaan'; headerColor = 'text-blue-700'; }
        else if (normalizedStatus === 'wiraswasta') { headerText = 'Detail Usaha'; headerColor = 'text-green-700'; }
        else if (normalizedStatus === 'melanjutkan_pendidikan') { headerText = 'Detail Pendidikan Lanjutan'; headerColor = 'text-blue-700'; }
        else if (normalizedStatus === 'tidak_bekerja') { headerText = 'Informasi Pencarian Kerja'; headerColor = 'text-yellow-700'; }

        container.innerHTML = `
            <div class="bg-gray-50/80 p-5 rounded-lg border border-gray-200 mt-2 shadow-sm">
                <h3 class="font-bold text-base ${headerColor} border-b border-gray-200 pb-2 mb-4">${headerText}</h3>
                <div id="questions-wrapper" class="space-y-4"></div>
            </div>
        `;

        const wrapper = document.getElementById('questions-wrapper');

        statusQuestions[normalizedStatus].forEach((question, index) => {
            const questionNumber = index + 1;
            const fieldName = `soal_${questionNumber}`;
            const fieldValue = values[fieldName] || '';

            const questionElement = document.createElement('div');
            
            questionElement.innerHTML = `
                <label class="block text-gray-800 text-sm font-bold mb-1.5">${question}</label>
                <input type="text"
                       name="${fieldName}"
                       placeholder="Jawaban Anda..."
                       class="w-full px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition shadow-sm"
                       value="${fieldValue.replace(/"/g, '&quot;')}"
                       required>
            `;

            wrapper.appendChild(questionElement);
        });
    }

    document.getElementById('status').addEventListener('change', function() {
        renderSoal(this.value);
    });

    @php
        $currentStatus = old('status', '');
        $initialValues = [];
        for ($i = 1; $i <= 8; $i++) {
            $initialValues["soal_$i"] = old("soal_$i", '');
        }
    @endphp

    window.addEventListener('DOMContentLoaded', function() {
        const status = @json($currentStatus);
        const initialValues = @json($initialValues);
        if (status) renderSoal(status, initialValues);
    });
</script>
@endsection