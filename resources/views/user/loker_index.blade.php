@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-6xl mx-auto px-4">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lowongan Kerja & Magang</h1>
            <p class="text-gray-500 mb-6">Temukan karir impianmu dari mitra perusahaan kami</p>
            
            <form action="{{ route('user.lokers.index') }}" method="GET" class="flex gap-4">
                <div class="flex-1 bg-white p-2 rounded-xl shadow-sm border border-gray-200 flex items-center px-4 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-search text-gray-400 mr-3"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posisi, perusahaan, atau lokasi..." class="w-full outline-none text-gray-600 bg-transparent">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-md shadow-blue-200">
                    Cari
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
                <p>{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">&times;</button>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($lokers as $loker)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col md:flex-row items-start md:items-center gap-6 group">
                
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition">
                    {{ substr($loker->perusahaan, 0, 2) }}
                </div>

                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition mb-1">{{ $loker->judul }}</h3>
                    <p class="text-gray-500 font-medium mb-2 flex items-center gap-2">
                        <i class="fas fa-building text-xs"></i> {{ $loker->perusahaan }}
                    </p>
                    
                    <div class="flex flex-wrap gap-2 text-xs font-semibold">
                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $loker->lokasi }}
                        </span>
                        <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full">
                            <i class="fas fa-clock mr-1"></i> Mulai: {{ $loker->tanggal_mulai->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-4 md:mt-0 w-full md:w-auto">
                    <a href="{{ route('user.lokers.show', $loker) }}" class="flex-1 md:flex-none text-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold transition shadow-md shadow-blue-200">
                        Detail Lowongan
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-gray-300">
                <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">Tidak ada lowongan ditemukan untuk pencarian "{{ request('search') }}"</p>
                <a href="{{ route('user.lokers.index') }}" class="text-blue-600 font-bold text-sm mt-2 inline-block">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $lokers->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection