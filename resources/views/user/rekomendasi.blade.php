@extends('layouts.app')

@section('content')
<div id="loker-data" data-jobs="{{ json_encode($lokers) }}" class="hidden"></div>

<div class="py-8 bg-gray-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            {{-- SIDEBAR KIRI --}}
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center sticky top-24">
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full p-[2px] shadow-sm">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                                @if(Auth::user()->alumni && Auth::user()->alumni->Foto)
                                    <img src="{{ asset('storage/' . Auth::user()->alumni->Foto) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl font-bold text-gray-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h2 class="text-base font-bold text-gray-800 truncate px-2">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-xs mb-6 font-medium">Mahasiswa / Alumni</p>

                    <nav class="space-y-1.5 text-left">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-home w-5 text-center"></i> Overview
                        </a>
                        <a href="{{ route('user.tracer.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        {{-- MENU AKTIF --}}
                        <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            {{-- KONTEN KANAN (Rekomendasi Karir) --}}
            <div class="w-full lg:w-3/4 space-y-6">
                
                {{-- HEADER --}}
                <div class="pb-1 border-b border-gray-200/60 mb-4">
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Rekomendasi Karir</h1>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Lowongan yang dipilihkan khusus berdasarkan skill Anda.</p>
                </div>

                {{-- Container Hasil Javascript --}}
                <div id="recommendation-container" class="space-y-3">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
                        <i class="fas fa-circle-notch fa-spin text-blue-500 text-2xl mb-3"></i>
                        <p class="text-gray-500 font-medium text-sm">Menganalisis profil & skill Anda...</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSkills = JSON.parse(localStorage.getItem('user_skills') || '[]');
        
        let allJobs = [];
        try {
            const rawData = document.getElementById('loker-data').dataset.jobs;
            allJobs = JSON.parse(rawData);
        } catch (e) { console.error("Error load data", e); }
        
        const container = document.getElementById('recommendation-container');
        container.innerHTML = '';

        let matchedJobs = [];

        if (userSkills.length > 0) {
            matchedJobs = allJobs.filter(job => {
                const text = (job.judul + ' ' + job.deskripsi).toLowerCase();
                return userSkills.some(skill => text.includes(skill.toLowerCase()));
            });
        }

        if (matchedJobs.length > 0) {
            
            const skillInfo = `
            <div class="bg-blue-50 text-blue-800 px-4 py-3 rounded-xl text-sm mb-4 border border-blue-100 flex items-center gap-3">
                <i class="fas fa-info-circle text-blue-600"></i> 
                <span>Ditemukan <b class="font-bold">${matchedJobs.length} lowongan</b> yang cocok dengan skill: <b class="font-bold capitalize">${userSkills.join(', ')}</b></span>
            </div>`;
            container.innerHTML = skillInfo;

            matchedJobs.forEach(job => {
                const detailUrl = "{{ url('/user/lokers') }}/" + job.id;
                
                const card = `
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow transition duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        
                        <div class="flex items-center gap-4 w-full sm:w-auto flex-1">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg font-bold flex-shrink-0 border border-blue-100">
                                ${job.perusahaan.substring(0, 2).toUpperCase()}
                            </div>
                            
                            <div class="text-left min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="text-sm font-bold text-gray-800 truncate">${job.judul}</h3>
                                    <span class="bg-green-50 text-green-700 text-[10px] px-1.5 py-0.5 rounded font-semibold uppercase border border-green-200">
                                        <i class="fas fa-check mr-0.5"></i> Cocok
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 font-medium truncate">
                                    ${job.perusahaan} &bull; <i class="fas fa-map-marker-alt text-gray-400 mx-0.5"></i> ${job.lokasi}
                                </p>
                            </div>
                        </div>

                        <div class="w-full sm:w-auto flex-shrink-0 mt-2 sm:mt-0">
                            <a href="${detailUrl}" class="block w-full sm:w-auto bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg font-semibold text-xs hover:border-blue-500 hover:text-blue-600 transition text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        } else {
            let message = userSkills.length === 0 
                ? "Sistem tidak mendeteksi skill di profil Anda. Silakan perbarui profil." 
                : "Belum ada lowongan yang sesuai dengan kombinasi skill Anda saat ini.";
                
            container.innerHTML = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center flex flex-col items-center">
                    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-100">
                        <i class="fas fa-search text-xl text-gray-400"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-1">Belum Ada Rekomendasi</h3>
                    <p class="text-gray-500 text-sm mb-5 max-w-sm mx-auto">${message}</p>
                    
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('profile.edit') }}" class="bg-white border border-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold text-xs hover:bg-gray-50 transition">
                            Update Skill
                        </a>
                        <a href="{{ route('user.lokers.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold text-xs hover:bg-blue-700 transition">
                            Eksplor Lowongan
                        </a>
                    </div>
                </div>`;
        }
    });
</script>
@endsection