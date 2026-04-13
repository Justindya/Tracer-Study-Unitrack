@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- SIDEBAR KIRI (SINKRON DENGAN DASHBOARD) --}}
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
                
                {{-- HEADER SINKRON --}}
                <div class="pb-2 border-b border-gray-200">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detail Data Tracer</h1>
                    <p class="text-sm text-gray-500 mt-1.5 font-medium">Rincian kuesioner pelacakan karir Anda.</p>
                </div>

                {{-- LOGIKA TARIK DATA (ANTI-BUG) --}}
                @php
                    $rawStatus = $tracer->status;
                    // Normalisasi String agar nyambung dengan DB baru
                    $normStatus = $rawStatus;
                    if($rawStatus == 'melanjutkan') $normStatus = 'melanjutkan_pendidikan';
                    if($rawStatus == 'tidak bekerja') $normStatus = 'tidak_bekerja';

                    $soalLabels = [
                        'bekerja' => [
                            'Berapa lama anda mendapatkan pekerjaan?',
                            'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)?',
                            'Lokasi Tempat Anda Bekerja (Provinsi)',
                            'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
                            'Jenis Perusahaan tempat anda bekerja',
                            'Nama Perusahaan tempat anda bekerja',
                            'Kategori perusahaan tempat anda bekerja',
                            'Informasi yang anda dapatkan untuk mencari pekerjaan',
                        ],
                        'wiraswasta' => [
                            'Apakah jabatan/posisi anda ketika Berwirausaha?',
                            'Nama Usaha anda',
                            'Pendapatan per bulan anda',
                            'Bidang Usaha',
                            'Berapa lama anda memulai usaha?',
                        ],
                        'melanjutkan_pendidikan' => [
                            'Jenjang melanjutkan',
                            'Nama Perguruan Tinggi',
                            'Nama Program Studi',
                            'Tanggal Bulan Tahun Masuk',
                            'Sumber Biaya',
                        ],
                        'tidak_bekerja' => [
                            'Berapa perusahaan/instansi yang sudah anda lamar?',
                            'Berapa banyak respons lamaran anda?',
                            'Berapa banyak undangan wawancara?',
                        ],
                    ];

                    $jawaban = null;
                    $alumniId = Auth::user()->alumni->id ?? $tracer->alumni_id;

                    if ($normStatus == 'bekerja') $jawaban = \App\Models\bekerja::where('alumni_id', $alumniId)->first();
                    elseif ($normStatus == 'wiraswasta') $jawaban = \App\Models\wiraswasta::where('alumni_id', $alumniId)->first();
                    elseif ($normStatus == 'melanjutkan_pendidikan') $jawaban = \App\Models\melanjutkan_pendidikan::where('alumni_id', $alumniId)->first();
                    elseif ($normStatus == 'tidak_bekerja') $jawaban = \App\Models\tidak_bekerja::where('alumni_id', $alumniId)->first();
                @endphp

                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 overflow-hidden">
                    
                    {{-- BANNER STATUS --}}
                    <div class="bg-blue-50/50 p-6 sm:p-8 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Status Karir</p>
                            <h2 class="text-xl font-black text-blue-700 capitalize">{{ str_replace('_', ' ', $normStatus) }}</h2>
                        </div>
                        <div class="sm:text-right">
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal Mulai</p>
                            <h2 class="text-base font-bold text-gray-900">{{ $tracer->tanggal_mulai->format('d M Y') }}</h2>
                        </div>
                    </div>

                    {{-- LIST JAWABAN --}}
                    <div class="p-6 sm:p-8">
                        @if ($jawaban && isset($soalLabels[$normStatus]))
                            <ul class="space-y-6">
                                @foreach ($soalLabels[$normStatus] as $i => $label)
                                    <li class="flex flex-col sm:flex-row sm:items-start gap-2 sm:gap-6 border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                                        <div class="w-full sm:w-5/12">
                                            <span class="text-xs font-bold text-gray-500 leading-relaxed">{{ $label }}</span>
                                        </div>
                                        <div class="w-full sm:w-7/12">
                                            <span class="text-sm font-bold text-gray-900 bg-gray-50 px-3 py-1.5 rounded-lg block border border-gray-100">
                                                {{ $jawaban->{'soal_' . ($i + 1)} ?? '-' }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100 flex items-start gap-4">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-yellow-500 flex-shrink-0 shadow-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-yellow-800">Data Rincian Kosong</h3>
                                    <p class="text-xs text-yellow-600 mt-1">Rincian kuesioner untuk status ini belum diisi secara lengkap. Silakan edit data untuk melengkapinya.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    {{-- FOOTER AKSI --}}
                    <div class="bg-gray-50/50 p-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 items-center justify-end">
                        <a href="{{ route('user.tracer.index') }}" class="w-full sm:w-auto bg-white border border-gray-200 text-gray-700 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-gray-100 transition shadow-sm text-center">
                            Kembali
                        </a>
                        <a href="{{ route('user.tracer.edit', $tracer->id) }}" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition shadow-sm flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i> Edit Data Tracer
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection