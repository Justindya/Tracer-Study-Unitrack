<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        .activity-scroll::-webkit-scrollbar { width: 4px; }
        .activity-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
        .activity-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>

    <div class="py-8 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="w-full md:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm p-5 text-center sticky top-24 border border-gray-100">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-600 text-2xl font-bold border-4 border-blue-50 shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }} 
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 text-xs mb-5">Mahasiswa / Alumni</p>

                        <div class="space-y-1 text-left">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }}">
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
                            <a href="{{ route('user.rekomendasi') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-magic w-4 text-center"></i> Rekomendasi
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-3/4 space-y-6">
                    
                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                        <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas dan status karirmu.</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-blue-500 hover:-translate-y-1 transition text-center border border-gray-50">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-2 text-blue-600"><i class="fas fa-paper-plane"></i></div>
                            <h4 class="text-xl font-bold text-gray-800 leading-none">{{ $lamaranCount }}</h4>
                            <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold mt-1">Terkirim</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-green-500 hover:-translate-y-1 transition text-center border border-gray-50">
                            <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-2 text-green-600"><i class="fas fa-check-circle"></i></div>
                            <h4 class="text-xl font-bold text-gray-800 leading-none">{{ $diterimaCount }}</h4>
                            <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold mt-1">Diterima</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-yellow-500 hover:-translate-y-1 transition text-center border border-gray-50">
                            <div class="w-10 h-10 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-2 text-yellow-600"><i class="fas fa-clock"></i></div>
                            <h4 class="text-xl font-bold text-gray-800 leading-none">{{ $diprosesCount }}</h4>
                            <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold mt-1">Diproses</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-cyan-500 hover:-translate-y-1 transition text-center border border-gray-50">
                            <div class="w-10 h-10 bg-cyan-50 rounded-full flex items-center justify-center mx-auto mb-2 text-cyan-600"><i class="fas fa-bookmark"></i></div>
                            <h4 id="count-bookmark" class="text-xl font-bold text-gray-800 leading-none">0</h4>
                            <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold mt-1">Bookmark</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col h-full">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-1.5 bg-blue-100 rounded-lg text-blue-600"><i class="fas fa-user-edit text-sm"></i></div>
                                <h3 class="font-bold text-gray-800 text-sm">Status Profil</h3>
                            </div>
                            
                            @php 
                                $isComplete = Auth::user()->alumni;
                                $progress = $isComplete ? 100 : 50; 
                            @endphp

                            <div class="mb-2">
                                <div class="flex justify-between items-end mb-1">
                                    <p class="text-xs text-gray-500">Kelengkapan Data</p>
                                    <span class="text-sm font-bold {{ $isComplete ? 'text-green-600' : 'text-orange-500' }}">{{ $progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-1000 {{ $isComplete ? 'bg-green-500' : 'bg-orange-400' }}" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-50">
                                @if(!$isComplete)
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-exclamation-circle text-orange-500 mt-0.5 text-xs"></i>
                                        <div>
                                            <p class="text-xs text-orange-800 font-bold">Data Belum Lengkap</p>
                                            <p class="text-[10px] text-gray-500 mb-2">Lengkapi data agar bisa melamar.</p>
                                            <a href="{{ route('user.tracer.create') }}" class="text-[10px] text-blue-600 font-bold hover:underline">Update Sekarang -></a>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-check-circle text-green-500 mt-0.5 text-xs"></i>
                                        <div>
                                            <p class="text-xs text-green-800 font-bold">Profil Lengkap!</p>
                                            <p class="text-[10px] text-gray-500">Akun Anda siap digunakan.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 h-full flex flex-col">
                            <div class="flex items-center gap-3 mb-4 border-b border-gray-50 pb-3">
                                <div class="p-1.5 bg-purple-100 rounded-lg text-purple-600"><i class="fas fa-history text-sm"></i></div>
                                <h3 class="font-bold text-gray-800 text-sm">Aktivitas Terbaru</h3>
                            </div>

                            <div class="flex-1 overflow-y-auto activity-scroll space-y-3 max-h-[150px] pr-1">
                                @forelse($activities as $act)
                                    <div class="flex gap-3 relative">
                                        <div class="flex flex-col items-center mt-1">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full ring-2 ring-blue-50"></div>
                                            @if(!$loop->last)
                                                <div class="w-0.5 h-full bg-gray-200 my-0.5"></div>
                                            @endif
                                        </div>
                                        <div class="pb-3">
                                            <p class="text-[10px] font-bold text-gray-800">
                                                Lamaran {{ ucfirst($act->status) }}
                                            </p>
                                            <p class="text-[10px] text-gray-500">
                                                Posisi <span class="font-semibold text-blue-600">{{ $act->loker->judul ?? 'Lowongan' }}</span>.
                                            </p>
                                            <p class="text-[9px] text-gray-400">{{ $act->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex gap-3 relative">
                                        <div class="flex flex-col items-center">
                                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                            <div class="w-0.5 h-full bg-gray-100 my-0.5"></div>
                                        </div>
                                        <div class="pb-2">
                                            <p class="text-[10px] text-gray-400">Belum ada aktivitas lamaran.</p>
                                        </div>
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