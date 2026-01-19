@extends('layouts.app')

@section('content')
<div id="loker-data" data-jobs="{{ json_encode($lokers) }}" class="hidden"></div>

<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-6">
            
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
                        <a href="{{ route('user.tracer.create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-edit w-4 text-center"></i> Update Tracer
                        </a>
                        <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-file-alt w-4 text-center"></i> Lamaran Saya
                        </a>
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-bookmark w-4 text-center"></i> Bookmark
                        </a>
                        <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition bg-blue-600 text-white shadow-md shadow-blue-200">
                            <i class="fas fa-magic w-4 text-center"></i> Rekomendasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-3/4">
                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h1 class="text-2xl font-bold text-gray-900">Rekomendasi Karir</h1>
                    <p class="text-sm text-gray-500 mt-1">Lowongan yang dipilihkan khusus berdasarkan skill Anda.</p>
                </div>

                <div id="recommendation-container" class="space-y-4">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
                        <i class="fas fa-circle-notch fa-spin text-blue-500 text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Menganalisis profil & skill Anda...</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil Skill User dari LocalStorage
        const userSkills = JSON.parse(localStorage.getItem('user_skills') || '[]');
        
        // Ambil Data Lowongan dari Controller
        let allJobs = [];
        try {
            const rawData = document.getElementById('loker-data').dataset.jobs;
            allJobs = JSON.parse(rawData);
        } catch (e) { console.error("Error load data", e); }
        
        const container = document.getElementById('recommendation-container');
        container.innerHTML = '';

        let matchedJobs = [];

        // 1. LOGIKA MATCHING (Cari yang skill-nya cocok)
        if (userSkills.length > 0) {
            matchedJobs = allJobs.filter(job => {
                const text = (job.judul + ' ' + job.deskripsi).toLowerCase();
                return userSkills.some(skill => text.includes(skill.toLowerCase()));
            });
        }

        // 2. RENDER HASIL
        if (matchedJobs.length > 0) {
            // Tampilkan Info Skill yang Cocok
            const skillInfo = `<div class="bg-blue-50 text-blue-700 px-4 py-3 rounded-xl text-sm mb-4 border border-blue-100">
                <i class="fas fa-info-circle mr-2"></i> Ditemukan <b>${matchedJobs.length} lowongan</b> yang cocok dengan skill: <b>${userSkills.join(', ')}</b>
            </div>`;
            container.innerHTML = skillInfo;

            matchedJobs.forEach(job => {
                const detailUrl = "{{ url('/user/lokers') }}/" + job.id;
                
                // Card Style (Full Width Rapi)
                const card = `
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group flex flex-col md:flex-row items-center gap-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center text-white text-2xl font-bold flex-shrink-0 shadow-md">
                            ${job.perusahaan.substring(0, 2).toUpperCase()}
                        </div>
                        
                        <div class="flex-1 w-full text-center md:text-left">
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-2 mb-1 justify-center md:justify-start">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition">${job.judul}</h3>
                                <span class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded font-bold uppercase border border-green-200">90% Cocok</span>
                            </div>
                            <p class="text-gray-500 text-sm mb-3 font-medium">${job.perusahaan}</p>
                            
                            <div class="flex flex-wrap justify-center md:justify-start gap-2">
                                <span class="bg-gray-50 text-gray-600 px-3 py-1 rounded-lg text-xs font-semibold border border-gray-200"><i class="fas fa-map-marker-alt mr-1"></i> ${job.lokasi}</span>
                                <span class="bg-gray-50 text-gray-600 px-3 py-1 rounded-lg text-xs font-semibold border border-gray-200"><i class="fas fa-clock mr-1"></i> Full Time</span>
                            </div>
                        </div>

                        <div class="w-full md:w-auto">
                            <a href="${detailUrl}" class="block w-full md:w-auto bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition text-center shadow-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        } else {
            // JIKA TIDAK ADA YANG COCOK / SKILL KOSONG
            let message = userSkills.length === 0 
                ? "Anda belum menambahkan skill di Profil." 
                : "Belum ada lowongan yang cocok dengan skill Anda saat ini.";
                
            container.innerHTML = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <i class="fas fa-magic text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Rekomendasi</h3>
                    <p class="text-gray-500 text-sm mb-6">${message}</p>
                    <div class="flex gap-3">
                        <a href="{{ route('profile.edit') }}" class="bg-white border border-gray-300 text-gray-700 px-5 py-2 rounded-lg font-bold text-sm hover:bg-gray-50 transition">Update Skill</a>
                        <a href="{{ route('user.lokers.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-md">Lihat Semua Lowongan</a>
                    </div>
                </div>`;
        }
    });
</script>
@endsection