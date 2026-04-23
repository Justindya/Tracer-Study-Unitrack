<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .activity-scroll::-webkit-scrollbar { width: 4px; }
        .activity-scroll::-webkit-scrollbar-track { background: transparent; }
        .activity-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .activity-scroll::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>

    <div class="py-8 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6 items-start">
                
                {{-- SIDEBAR KIRI (Ditambahkan self-start agar tidak gantung) --}}
                <div class="w-full lg:w-1/4 self-start">
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
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                <i class="fas fa-home w-5 text-center"></i> Overview
                            </a>
                            <a href="{{ $tracerComplete ? route('user.tracer.index') : route('user.tracer.create') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                                <i class="fas {{ $tracerComplete ? 'fa-check-circle text-green-500' : 'fa-clipboard-list' }} w-5 text-center"></i> 
                                {{ $tracerComplete ? 'Data Tracer' : 'Isi Tracer Study' }}
                            </a>
                            <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
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

                {{-- KONTEN KANAN UTAMA --}}
                <div class="w-full lg:w-3/4 space-y-6">
                    
                    {{-- HEADER --}}
                    <div class="pb-1 border-b border-gray-200/60 mb-4">
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Pantau progres karir dan status lamaranmu.</p>
                    </div>

                    {{-- KPI CARDS --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Terkirim</p>
                                <div class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-paper-plane text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $lamaranCount }}</h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Diterima</p>
                                <div class="w-7 h-7 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                                    <i class="fas fa-check-circle text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $diterimaCount }}</h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Diproses</p>
                                <div class="w-7 h-7 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600">
                                    <i class="fas fa-clock text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $diprosesCount }}</h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Bookmark</p>
                                <div class="w-7 h-7 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-600">
                                    <i class="fas fa-bookmark text-[10px]"></i>
                                </div>
                            </div>
                            <h3 id="count-bookmark" class="text-2xl font-bold text-gray-800">0</h3>
                        </div>
                    </div>

                    {{-- GRID BAWAH --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        
                        {{-- KELENGKAPAN PROFIL --}}
                        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col h-full">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-gray-800 text-base tracking-tight">Kelengkapan Profil</h3>
                                <span class="text-[11px] font-bold {{ $progress == 100 ? 'text-green-700 bg-green-50' : 'text-blue-700 bg-blue-50' }} px-2.5 py-1 rounded-md">{{ $progress }}%</span>
                            </div>

                            <div class="flex-1 px-1">
                                <ul class="relative border-l border-gray-200 space-y-6 pb-2 ml-2">
                                    
                                    {{-- STEP 1: Akun --}}
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 bg-green-500 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white">
                                            <i class="fas fa-check text-white text-[8px]"></i>
                                        </span>
                                        <h4 class="font-semibold text-gray-800 text-sm">Akun Terdaftar</h4>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Registrasi berhasil dilakukan.</p>
                                    </li>

                                    {{-- STEP 2: Biodata --}}
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white {{ $bioComplete ? 'bg-green-500' : 'bg-gray-200' }}">
                                            @if($bioComplete)
                                                <i class="fas fa-check text-white text-[8px]"></i>
                                            @endif
                                        </span>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold {{ $bioComplete ? 'text-gray-800' : 'text-gray-500' }} text-sm">Biodata Lengkap</h4>
                                                <p class="text-[11px] text-gray-400 mt-0.5">{{ $bioComplete ? 'Data diri sudah diperbarui.' : 'Data diri dan kontak belum lengkap.' }}</p>
                                            </div>
                                            @if(!$bioComplete && Auth::user()->alumni)
                                                <a href="{{ route('user.alumni.edit', Auth::user()->alumni->id) }}" class="text-blue-600 hover:underline text-[11px] font-semibold">Lengkapi</a>
                                            @endif
                                        </div>
                                    </li>

                                    {{-- STEP 3: Tracer Study --}}
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white {{ $tracerComplete ? 'bg-green-500' : 'bg-gray-200' }}">
                                            @if($tracerComplete)
                                                <i class="fas fa-check text-white text-[8px]"></i>
                                            @endif
                                        </span>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold {{ $tracerComplete ? 'text-gray-800' : 'text-gray-500' }} text-sm">Tracer Study</h4>
                                                <p class="text-[11px] text-gray-400 mt-0.5">{{ $tracerComplete ? 'Status karir telah terekam.' : 'Kuesioner karir belum diisi.' }}</p>
                                            </div>
                                            @if(!$tracerComplete)
                                                <a href="{{ route('user.tracer.create') }}" class="text-blue-600 hover:underline text-[11px] font-semibold">Isi Sekarang</a>
                                            @endif
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        {{-- AKTIVITAS TERKINI --}}
                        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm h-full flex flex-col">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-gray-800 text-base tracking-tight">Aktivitas Terkini</h3>
                                <a href="{{ route('user.lamaran.index') }}" class="text-[11px] font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                            </div>

                            <div class="flex-1 overflow-y-auto activity-scroll space-y-0 max-h-[220px] pr-2">
                                @forelse($activities as $act)
                                    <div class="relative pl-5 pb-5">
                                        <div class="absolute left-0 top-1.5 w-1.5 h-1.5 bg-blue-400 rounded-full ring-2 ring-white z-10"></div>
                                        @if(!$loop->last)
                                            <div class="absolute left-[2px] top-3 bottom-[-10px] w-[1px] bg-gray-100"></div>
                                        @endif
                                        
                                        <div>
                                            <div class="flex justify-between items-baseline mb-0.5">
                                                <p class="text-sm font-semibold text-gray-800 leading-none">Lamaran <span class="capitalize">{{ $act->status }}</span></p>
                                                <span class="text-[10px] text-gray-400">{{ $act->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 truncate max-w-[200px] sm:max-w-[250px]">{{ $act->loker->judul ?? 'Lowongan telah dihapus' }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="h-full flex flex-col items-center justify-center text-center py-8">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-ghost text-gray-300 text-xl"></i>
                                        </div>
                                        <p class="text-xs font-semibold text-gray-600">Belum ada aktivitas</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
            const bookmarkElement = document.getElementById('count-bookmark');
            if (bookmarkElement) {
                bookmarkElement.innerText = bookmarks.length;
            }
        });
    </script>
</x-app-layout>