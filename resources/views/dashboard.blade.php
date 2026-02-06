<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .activity-scroll::-webkit-scrollbar { width: 4px; }
        .activity-scroll::-webkit-scrollbar-track { background: #f8fafc; }
        .activity-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .activity-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    <div class="py-6 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-5">
                
                <div class="w-full md:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center sticky top-20">
                        <div class="relative w-20 h-20 mx-auto mb-3">
                            <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-purple-600 rounded-full p-[2px] shadow-md">
                                <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden">
                                    @if(Auth::user()->alumni && Auth::user()->alumni->Foto)
                                        <img src="{{ asset('storage/' . Auth::user()->alumni->Foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-2xl font-bold text-gray-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h2 class="text-base font-bold text-gray-800 truncate">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 text-[11px] mb-4">Mahasiswa / Alumni</p>

                        <nav class="space-y-1 text-left">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-home w-4 text-center"></i> Overview
                            </a>
                            <a href="{{ $tracerComplete ? route('user.tracer.index') : route('user.tracer.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas {{ $tracerComplete ? 'fa-check-circle text-green-500' : 'fa-clipboard-list' }} w-4 text-center"></i> 
                                {{ $tracerComplete ? 'Data Tracer' : 'Isi Tracer Study' }}
                            </a>
                            <a href="{{ route('user.lamaran.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-briefcase w-4 text-center"></i> Lamaran Saya
                            </a>
                            <a href="{{ route('user.bookmark.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-heart w-4 text-center"></i> Bookmark
                            </a>
                            <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-star w-4 text-center"></i> Rekomendasi
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="w-full md:w-3/4 space-y-5">
                    
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-6 text-white shadow-md relative overflow-hidden flex items-center justify-between">
                        <div class="relative z-10">
                            <h1 class="text-xl font-bold mb-1">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                            <p class="text-blue-100 text-xs">Pantau progres karirmu hari ini.</p>
                        </div>
                        <div class="hidden sm:block opacity-20">
                            <i class="fas fa-rocket text-6xl transform rotate-12"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center items-center hover:border-blue-200 transition">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Terkirim</span>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-paper-plane text-blue-500 text-sm"></i>
                                <h3 class="text-xl font-bold text-gray-800">{{ $lamaranCount }}</h3>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center items-center hover:border-green-200 transition">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Diterima</span>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                <h3 class="text-xl font-bold text-gray-800">{{ $diterimaCount }}</h3>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center items-center hover:border-yellow-200 transition">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Diproses</span>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-yellow-500 text-sm"></i>
                                <h3 class="text-xl font-bold text-gray-800">{{ $diprosesCount }}</h3>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center items-center hover:border-cyan-200 transition">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Bookmark</span>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bookmark text-cyan-500 text-sm"></i>
                                <h3 id="count-bookmark" class="text-xl font-bold text-gray-800">0</h3>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col h-full">
                            <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-2">
                                <h3 class="font-bold text-gray-800 text-sm">Status Profil</h3>
                                <span class="text-xs font-bold {{ $progress == 100 ? 'text-green-600 bg-green-50' : 'text-blue-600 bg-blue-50' }} px-2 py-0.5 rounded">{{ $progress }}%</span>
                            </div>

                            <div class="space-y-3 flex-1">
                                <div class="flex items-center justify-between p-2.5 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]"><i class="fas fa-check"></i></div>
                                        <span class="text-xs text-gray-700 font-medium">Akun Terdaftar</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-2.5 rounded-lg {{ $bioComplete ? 'bg-gray-50' : 'bg-orange-50 border border-orange-100' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full {{ $bioComplete ? 'bg-green-500' : 'bg-orange-400' }} flex items-center justify-center text-white text-[10px]">
                                            <i class="fas {{ $bioComplete ? 'fa-check' : 'fa-user' }}"></i>
                                        </div>
                                        <span class="text-xs text-gray-700 font-medium">Biodata Lengkap</span>
                                    </div>
                                    @if(!$bioComplete && Auth::user()->alumni)
                                        <a href="{{ route('user.alumni.edit', Auth::user()->alumni->id) }}" class="text-[10px] text-blue-600 hover:underline font-bold">Isi ></a>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between p-2.5 rounded-lg {{ $tracerComplete ? 'bg-gray-50' : 'bg-blue-50 border border-blue-100' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full {{ $tracerComplete ? 'bg-green-500' : 'bg-blue-500' }} flex items-center justify-center text-white text-[10px]">
                                            <i class="fas {{ $tracerComplete ? 'fa-check' : 'fa-chart-pie' }}"></i>
                                        </div>
                                        <span class="text-xs text-gray-700 font-medium">Tracer Study</span>
                                    </div>
                                    @if(!$tracerComplete)
                                        <a href="{{ route('user.tracer.create') }}" class="text-[10px] text-blue-600 hover:underline font-bold">Isi ></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 h-full flex flex-col">
                            <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-2">
                                <h3 class="font-bold text-gray-800 text-sm">Aktivitas Terkini</h3>
                                <a href="{{ route('user.lamaran.index') }}" class="text-[10px] text-gray-400 hover:text-blue-600">Semua</a>
                            </div>

                            <div class="flex-1 overflow-y-auto activity-scroll space-y-3 max-h-[200px] pr-1">
                                @forelse($activities as $act)
                                    <div class="flex gap-3 group">
                                        <div class="flex flex-col items-center mt-1">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                            @if(!$loop->last)<div class="w-px h-full bg-gray-100 my-0.5"></div>@endif
                                        </div>
                                        <div class="pb-2 flex-1">
                                            <div class="flex justify-between">
                                                <p class="text-xs font-bold text-gray-800">Lamaran {{ ucfirst($act->status) }}</p>
                                                <span class="text-[9px] text-gray-400">{{ $act->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-[10px] text-gray-500 truncate max-w-[150px]">{{ $act->loker->judul ?? 'Lowongan' }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-6">
                                        <i class="fas fa-ghost text-gray-200 text-xl mb-1"></i>
                                        <p class="text-[10px] text-gray-400">Belum ada aktivitas.</p>
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
            document.getElementById('count-bookmark').innerText = bookmarks.length;
        });
    </script>
</x-app-layout>