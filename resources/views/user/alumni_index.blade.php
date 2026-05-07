@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Networking Alumni dan Mahasiswa</h1>
            <p class="text-gray-500">Temukan teman seangkatan dan bangun relasi profesional.</p>
        </div>

        <form action="{{ route('user.alumni.index') }}" method="GET" class="mb-10 max-w-5xl mx-auto">
            <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-2">
                
                <div class="flex-1 flex items-center px-4 py-2 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-search text-gray-400 mr-3 text-lg"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama alumni atau angkatan..." 
                           class="w-full bg-transparent border-none focus:ring-0 outline-none text-gray-700 placeholder-gray-400">
                </div>

                <div class="w-full md:w-1/3 flex items-center px-4 py-2 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-graduation-cap text-gray-400 mr-3 text-lg"></i>
                    <select name="jurusan" class="w-full bg-transparent border-none focus:ring-0 outline-none text-gray-700 cursor-pointer appearance-none">
                        <option value="">Semua Jurusan</option>
                        @php
                            $jurusans = ['Ilmu Komputer', 'Gizi', 'Bisnis Digital'];
                        @endphp
                        @foreach($jurusans as $j)
                            <option value="{{ $j }}" {{ request('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down text-gray-400 ml-2 text-xs"></i>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-md flex items-center justify-center gap-2">
                    Cari <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($alumni as $a)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-lg hover:-translate-y-1 transition duration-300 flex flex-col items-center group relative overflow-hidden">
                
                @if($a->tahun_lulus == '-' || !$a->tahun_lulus)
                    <div class="absolute top-4 right-[-35px] bg-blue-100 text-blue-700 text-[10px] font-bold px-10 py-1 rotate-45 z-10">Mahasiswa</div>
                @else
                    <div class="absolute top-4 right-[-35px] bg-green-100 text-green-700 text-[10px] font-bold px-10 py-1 rotate-45 z-10">Alumni</div>
                @endif

                <a href="{{ route('user.alumni.show', $a->id) }}" class="flex flex-col items-center w-full mt-2">
                    <div class="mb-4 relative">
                        @if($a->Foto)
                            <img src="{{ asset('storage/' . $a->Foto) }}" alt="{{ $a->nama }}" class="w-24 h-24 rounded-full object-cover border-4 border-slate-50 group-hover:border-ush-blue/20 transition shadow-sm">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center text-slate-600 text-3xl font-bold border-4 border-white group-hover:border-ush-blue/20 transition shadow-sm">
                                {{ substr($a->nama, 0, 1) }}
                            </div>
                        @endif
                        <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-1 truncate w-full group-hover:text-blue-600 transition relative z-20">{{ $a->nama }}</h3>
                    <p class="text-sm text-blue-600 font-medium mb-1 truncate w-full relative z-20">{{ $a->program_studi }}</p>
                    <p class="text-xs text-gray-500 mb-4 bg-gray-50 px-2 py-1 rounded-full border border-gray-100 relative z-20">
                    </p>
                </a>

                <a href="{{ route('user.alumni.show', $a->id) }}" class="w-full py-2 rounded-xl font-bold text-sm transition shadow-sm bg-blue-600 text-white hover:bg-blue-700 active:scale-95 block relative z-20">
                    Lihat Profil
                </a>

            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-users-slash text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada profil ditemukan</h3>
                <p class="text-gray-500 text-sm">Coba ubah kata kunci atau filter jurusan.</p>
                <a href="{{ route('user.alumni.index') }}" class="inline-block mt-4 text-blue-600 font-bold hover:underline text-sm">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $alumni->appends(request()->query())->links() }}
        </div>

    </div>
</div>
@endsection