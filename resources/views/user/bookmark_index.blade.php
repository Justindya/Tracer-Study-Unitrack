@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            {{-- SIDEBAR KIRI - TETAP SAMA (DILARANG UBAH) --}}
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
                        <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            {{-- KONTEN KANAN --}}
            <div class="w-full lg:w-3/4 space-y-6">
                
                {{-- HEADER TETAP text-2xl --}}
                <div class="pb-1 border-b border-gray-200/60 mb-4 flex justify-between items-end gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Bookmark Saya</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Lowongan yang Anda simpan.</p>
                    </div>
                    <button id="btn-clear" onclick="clearBookmarks()" class="hidden text-red-600 text-xs font-bold hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg transition border border-red-200 flex items-center gap-2 mb-1 shadow-sm">
                        <i class="fas fa-trash-alt"></i> Hapus Semua
                    </button>
                </div>

                {{-- GRID COLS 1 (LIST VERTIKAL) --}}
                <div id="bookmark-container" class="grid grid-cols-1 gap-3"></div>

                <div id="empty-state" class="hidden bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center flex flex-col items-center">
                    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                        <i class="far fa-bookmark text-xl text-gray-400"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-1">Belum ada bookmark</h3>
                    <p class="text-gray-500 text-sm mb-5 max-w-sm mx-auto">Simpan lowongan favoritmu di sini.</p>
                    <a href="{{ route('user.lokers.index') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold text-xs hover:bg-blue-700 transition shadow-sm">Cari Lowongan</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function renderBookmarks() {
        let bookmarks = [];
        try { bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || []; } catch (e) {}

        const container = document.getElementById('bookmark-container');
        const emptyState = document.getElementById('empty-state');
        const btnClear = document.getElementById('btn-clear');

        container.innerHTML = '';

        if (bookmarks.length === 0) {
            emptyState.classList.remove('hidden');
            btnClear.classList.add('hidden'); 
        } else {
            btnClear.classList.remove('hidden');
            bookmarks.forEach(job => {
                const card = `
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:border-blue-200 transition duration-300 flex items-center justify-between gap-4">
                        
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg font-black flex-shrink-0 border border-blue-100">
                                ${job.company.substring(0, 2).toUpperCase()}
                            </div>
                            
                            <div class="min-w-0 text-left">
                                <h3 class="text-sm font-bold text-gray-800 truncate group-hover:text-blue-600 transition">
                                    ${job.title}
                                </h3>
                                <p class="text-[11px] text-gray-500 font-medium truncate mt-0.5">
                                    ${job.company}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <button onclick="removeOne('${job.id}')" 
                                    class="w-9 h-9 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition flex items-center justify-center" 
                                    title="Hapus dari Bookmark">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>

                            <a href="${job.url}" class="w-9 h-9 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition shadow-sm" title="Lihat Lowongan">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </div>

                    </div>
                `;
                container.innerHTML += card;
            });
        }
    }

    function removeOne(id) {
        if(confirm('Hapus lowongan ini dari bookmark?')) {
            let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
            bookmarks = bookmarks.filter(job => job.id != id);
            localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            renderBookmarks();
        }
    }

    function clearBookmarks() {
        if(confirm('Hapus SEMUA bookmark Anda?')) {
            localStorage.removeItem('bookmarks');
            renderBookmarks();
        }
    }
    renderBookmarks();
</script>
@endsection