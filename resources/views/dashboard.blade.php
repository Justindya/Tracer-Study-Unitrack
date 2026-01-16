<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="py-12 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                
                <div class="w-full md:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm p-6 text-center sticky top-24">
                        <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 text-3xl font-bold border-4 border-blue-50 shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }} 
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 text-sm mb-6">Mahasiswa / Alumni</p>

                        <div class="space-y-2 text-left">
                            <a href="{{ route('dashboard') }}" class="block bg-blue-600 text-white px-4 py-3 rounded-xl font-medium transition flex items-center gap-3 shadow-md shadow-blue-200 focus:outline-none">
                                <i class="fas fa-th-large w-5"></i> Overview
                            </a>
                            <a href="{{ route('user.tracer.create') }}" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 rounded-xl font-medium transition flex items-center gap-3 focus:outline-none">
                                <i class="fas fa-edit w-5"></i> Update Tracer
                            </a>
                            <a href="{{ route('user.lamaran.index') }}" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 rounded-xl font-medium transition flex items-center gap-3 focus:outline-none">
                                <i class="fas fa-file-alt w-5"></i> Lamaran Saya
                            </a>
                            <a href="{{ route('user.bookmark.index') }}" class="block text-gray-600 hover:bg-blue-50 hover:text-blue-600 px-4 py-3 rounded-xl font-medium transition flex items-center gap-3 focus:outline-none">
                                <i class="fas fa-bookmark w-5"></i> Bookmark
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-3/4 space-y-8">
                    
                    <h3 class="text-2xl font-bold text-gray-800">Dashboard Overview</h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-6 rounded-2xl shadow-sm text-center border-b-4 border-blue-500 hover:-translate-y-1 transition">
                            <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-600"><i class="fas fa-paper-plane text-xl"></i></div>
                            <h4 id="count-lamaran" class="text-2xl font-bold text-gray-800">0</h4>
                            <p class="text-xs text-gray-500 font-medium">Lamaran Terkirim</p>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm text-center border-b-4 border-green-500 hover:-translate-y-1 transition">
                            <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-3 text-green-600"><i class="fas fa-check-circle text-xl"></i></div>
                            <h4 class="text-2xl font-bold text-gray-800">0</h4>
                            <p class="text-xs text-gray-500 font-medium">Diterima</p>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm text-center border-b-4 border-yellow-500 hover:-translate-y-1 transition">
                            <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-3 text-yellow-600"><i class="fas fa-clock text-xl"></i></div>
                            <h4 class="text-2xl font-bold text-gray-800">0</h4>
                            <p class="text-xs text-gray-500 font-medium">Diproses</p>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm text-center border-b-4 border-cyan-500 hover:-translate-y-1 transition">
                            <div class="w-12 h-12 bg-cyan-50 rounded-full flex items-center justify-center mx-auto mb-3 text-cyan-600"><i class="fas fa-bookmark text-xl"></i></div>
                            <h4 id="count-bookmark" class="text-2xl font-bold text-gray-800">0</h4>
                            <p class="text-xs text-gray-500 font-medium">Bookmark</p>
                        </div>
                    </div>

                    @php
                        // Cek sederhana: jika user punya relasi alumni, anggap 100%, jika tidak 50%
                        $progress = Auth::user()->alumni ? 100 : 50; 
                    @endphp
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <h4 class="font-bold text-gray-800">Kelengkapan Profil</h4>
                                <p class="text-xs text-gray-500 mt-1">Lengkapi data tracer study Anda.</p>
                            </div>
                            <span class="font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-lg text-sm">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full shadow-lg shadow-blue-200 transition-all duration-1000" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6 rounded-2xl shadow-lg shadow-blue-200">
                        <h4 class="font-bold mb-4 flex items-center gap-2">
                            <i class="fas fa-history"></i> Aktivitas Terbaru
                        </h4>
                        <div id="activity-container" class="flex items-start gap-4 bg-white/10 p-4 rounded-xl backdrop-blur-sm">
                            <div class="w-3 h-3 mt-1.5 bg-green-400 rounded-full shadow-[0_0_10px_rgba(74,222,128,0.5)]"></div>
                            <div>
                                <p class="font-bold text-sm">Selamat Datang!</p>
                                <p class="text-xs text-blue-100 mt-1">Akun Anda berhasil dibuat. Mulai eksplorasi karir sekarang.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Update Angka Statistik
            const appliedJobs = JSON.parse(localStorage.getItem('appliedJobs') || '[]');
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');

            document.getElementById('count-lamaran').innerText = appliedJobs.length;
            document.getElementById('count-bookmark').innerText = bookmarks.length;

            // 2. Update Aktivitas Terbaru (Ambil lamaran terakhir)
            if (appliedJobs.length > 0) {
                const lastJob = appliedJobs[appliedJobs.length - 1];
                const activityHTML = `
                    <div class="w-3 h-3 mt-1.5 bg-yellow-400 rounded-full shadow-[0_0_10px_rgba(250,204,21,0.5)]"></div>
                    <div>
                        <p class="font-bold text-sm">Lamaran Dikirim</p>
                        <p class="text-xs text-blue-100 mt-1">
                            Anda baru saja melamar posisi <b>${lastJob.title}</b> di ${lastJob.company}.
                        </p>
                    </div>
                `;
                document.getElementById('activity-container').innerHTML = activityHTML;
            }
        });
    </script>
</x-app-layout>