@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-5xl mx-auto px-4">
        
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Lamaran Saya</h1>

        <div id="applied-container" class="space-y-4"></div>

        <div id="empty-state" class="hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center flex-col items-center justify-center min-h-[400px]">
            <div class="w-24 h-24 mb-6 text-gray-300">
                <i class="far fa-file-alt text-6xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada lamaran</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-8">Mulai melamar pekerjaan untuk melihat status di sini.</p>
            <a href="{{ route('user.lokers.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Lihat Lowongan</a>
        </div>

    </div>
</div>

<script>
    const appliedJobs = JSON.parse(localStorage.getItem('appliedJobs')) || [];
    const container = document.getElementById('applied-container');
    const emptyState = document.getElementById('empty-state');

    if (appliedJobs.length === 0) {
        emptyState.classList.remove('hidden');
        emptyState.classList.add('flex');
    } else {
        emptyState.classList.add('hidden'); // Sembunyikan empty state
        
        // Render setiap kartu
        appliedJobs.forEach(job => {
            const card = `
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6 hover:shadow-md transition">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl font-bold">
                        ${job.company.substring(0, 2)}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">${job.title}</h3>
                        <p class="text-gray-500 font-medium">${job.company}</p>
                        <span class="text-xs text-green-600 bg-green-50 px-3 py-1 rounded-full mt-2 inline-block">
                            <i class="fas fa-check-circle"></i> Dilamar via Email: ${job.appliedDate}
                        </span>
                    </div>
                    <a href="${job.url}" class="bg-gray-100 text-blue-600 px-6 py-2.5 rounded-lg font-bold hover:bg-blue-50 transition">
                        Lihat Detail
                    </a>
                </div>
            `;
            container.innerHTML += card;
        });
    }
</script>
@endsection