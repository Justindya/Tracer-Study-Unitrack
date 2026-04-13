@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            {{-- SIDEBAR KIRI (DASHBOARD) --}}
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
                        {{-- MENU AKTIF --}}
                        <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            {{-- KONTEN UTAMA --}}
            <div class="w-full lg:w-3/4 space-y-6">
                
                {{-- HEADER --}}
                <div class="pb-1 border-b border-gray-200/60 mb-4 flex justify-between items-end">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Riwayat Lamaran</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Kelola dan perbarui status lamaran kerja Anda secara mandiri.</p>
                    </div>
                    <div id="toast-success" class="hidden bg-green-50 text-green-700 px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-2 mb-1 border border-green-100">
                        <i class="fas fa-check"></i> Tersimpan
                    </div>
                </div>

                @if($lamarans->count() > 0)
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($lamarans as $history)
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow transition duration-200 flex items-center justify-between gap-4">
                            
                            <div class="flex items-center gap-4 min-w-0 flex-1">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg font-bold flex-shrink-0 border border-blue-100">
                                    {{ substr($history->loker->perusahaan ?? '?', 0, 2) }}
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-bold text-gray-800 truncate">
                                        {{ $history->loker->judul ?? 'Lowongan Dihapus' }}
                                    </h3>
                                    <p class="text-xs text-gray-500 font-medium truncate mt-0.5">
                                        {{ $history->loker->perusahaan ?? '-' }} &bull; Dilamar {{ $history->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div class="relative">
                                    @php
                                        $statusClass = 'bg-gray-50 text-gray-700 border-gray-200';
                                        if(strtolower($history->status) == 'terkirim') $statusClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                        elseif(strtolower($history->status) == 'diproses' || strtolower($history->status) == 'wawancara') $statusClass = 'bg-yellow-50 text-yellow-700 border-yellow-200';
                                        elseif(strtolower($history->status) == 'diterima') $statusClass = 'bg-green-50 text-green-700 border-green-200';
                                        elseif(strtolower($history->status) == 'ditolak') $statusClass = 'bg-red-50 text-red-700 border-red-200';
                                    @endphp
                                    
                                    <select class="status-updater appearance-none py-1.5 pl-3 pr-7 rounded-lg text-xs font-semibold border capitalize cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-400 {{ $statusClass }}" data-id="{{ $history->loker->id }}">
                                        <option value="terkirim" {{ strtolower($history->status) == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                                        <option value="diproses" {{ strtolower($history->status) == 'diproses' ? 'selected' : '' }}>Diproses / Review</option>
                                        <option value="wawancara" {{ strtolower($history->status) == 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                                        <option value="diterima" {{ strtolower($history->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ strtolower($history->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-current opacity-70">
                                        <i class="fas fa-chevron-down text-[10px]"></i>
                                    </div>
                                </div>

                                @if($history->loker)
                                    <a href="{{ route('user.lokers.show', $history->loker->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition" title="Lihat Lowongan">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </a>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center flex flex-col items-center">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-3 border border-gray-100">
                            <i class="far fa-file-alt text-xl text-gray-400"></i>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 mb-1">Belum ada lamaran</h3>
                        <p class="text-gray-500 text-sm mb-5 max-w-sm mx-auto">Ayo mulai langkah karirmu dan temukan pekerjaan impianmu sekarang.</p>
                        <a href="{{ route('user.lokers.index') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold text-xs hover:bg-blue-700 transition">
                            Cari Lowongan
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElements = document.querySelectorAll('.status-updater');
        const toast = document.getElementById('toast-success');

        selectElements.forEach(select => {
            select.addEventListener('change', function() {
                const lokerId = this.getAttribute('data-id');
                const newStatus = this.value;
                const element = this;

                document.body.style.cursor = 'wait';
                element.style.opacity = '0.5';

                fetch('{{ route("user.lokers.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        loker_id: lokerId,
                        status: newStatus
                    })
                })
                .then(res => {
                    if(!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    element.className = `status-updater appearance-none py-1.5 pl-3 pr-7 rounded-lg text-xs font-semibold border capitalize cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-400`;
                    
                    if(newStatus === 'terkirim') element.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');
                    else if(newStatus === 'diproses' || newStatus === 'wawancara') element.classList.add('bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                    else if(newStatus === 'diterima') element.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
                    else if(newStatus === 'ditolak') element.classList.add('bg-red-50', 'text-red-700', 'border-red-200');

                    document.body.style.cursor = 'default';
                    element.style.opacity = '1';

                    toast.classList.remove('hidden');
                    setTimeout(() => { toast.classList.add('hidden'); }, 2000);
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Gagal mengupdate status. Silakan coba lagi.');
                    document.body.style.cursor = 'default';
                    element.style.opacity = '1';
                });
            });
        });
    });
</script>
@endsection