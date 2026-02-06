@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- TOMBOL KEMBALI --}}
        <div class="mb-6">
            <a href="{{ route('user.events.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium transition text-sm">
                <i class="fas fa-arrow-left mr-2 bg-white p-2 rounded-full shadow-sm"></i> 
                Kembali ke Daftar Event
            </a>
        </div>

        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm flex items-center">
                <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- HERO CARD (JUDUL & AKSI) --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                
                {{-- 1. KOTAK TANGGAL (KIRI) --}}
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 bg-blue-600 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-blue-100">
                        <span class="text-3xl font-bold leading-none">{{ $event->tanggal->format('d') }}</span>
                        <span class="text-xs font-bold uppercase tracking-wider mt-1">{{ $event->tanggal->format('M') }}</span>
                    </div>
                </div>
                
                {{-- 2. INFORMASI UTAMA (TENGAH - RATA KIRI) --}}
                <div class="flex-1 text-left w-full">
                    <h1 class="text-3xl font-bold text-gray-900 mb-3 leading-tight">{{ $event->judul }}</h1>
                    
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            <span class="font-medium">{{ $event->tempat }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                            <i class="fas fa-clock text-amber-500"></i>
                            <span class="font-medium">{{ $event->jam }} WIB</span>
                        </div>
                    </div>
                </div>
                
                {{-- 3. TOMBOL AKSI (KANAN) --}}
                <div class="flex-shrink-0 w-full md:w-auto mt-4 md:mt-0">
                    @if($isRegistered)
                        <button disabled class="w-full md:w-auto px-8 py-3 bg-green-100 text-green-700 border border-green-200 rounded-xl font-bold flex items-center justify-center gap-2 cursor-default">
                            <i class="fas fa-check-circle"></i> 
                            <span>Sudah Terdaftar</span>
                        </button>
                    @else
                        <form action="{{ route('user.events.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-100 transform hover:-translate-y-1 transition duration-200 flex items-center justify-center gap-2" onclick="return confirm('Yakin ingin mendaftar event ini?')">
                                <span>Daftar Event</span>
                                <i class="fas fa-ticket-alt"></i>
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>

        {{-- GRID CONTENT (Deskripsi & Partisipan) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            {{-- KOLOM KIRI: DESKRIPSI (Lebih Lebar & Tinggi Fleksibel) --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-gray-100 h-fit">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-4">
                    <span class="bg-blue-50 text-blue-600 p-2 rounded-lg mr-3"><i class="fas fa-align-left"></i></span>
                    Detail & Deskripsi Acara
                </h3>
                <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed text-justify">
                    {!! nl2br(e($event->deskripsi)) !!}
                </div>
            </div>

            {{-- KOLOM KANAN: PARTISIPAN (Hanya Kotak Kecil) --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-fit sticky top-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Partisipasi</h4>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-md font-bold">Terbuka</span>
                </div>
                
                <div class="flex items-baseline gap-1 mb-2">
                    <span class="text-3xl font-extrabold text-gray-900">{{ $event->participants->count() }}</span>
                    <span class="text-sm text-gray-500 font-medium">Orang</span>
                </div>
                <p class="text-xs text-gray-400 mb-4">Telah mendaftar di event ini.</p>

                <div class="flex -space-x-2 overflow-hidden py-2 border-t border-gray-50">
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center text-[10px] text-gray-500 font-bold">A</div>
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-300 flex items-center justify-center text-[10px] text-gray-500 font-bold">B</div>
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-blue-100 flex items-center justify-center text-[10px] text-blue-600 font-bold">+{{ $event->participants->count() }}</div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection