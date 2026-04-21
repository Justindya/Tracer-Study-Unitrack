@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen py-8 font-sans relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('user.events.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium mb-6 text-sm transition focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Event
        </a>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl shadow-sm flex items-center font-medium text-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl shadow-sm flex items-center font-medium text-sm">
                <i class="fas fa-exclamation-triangle mr-2 text-red-500"></i> {{ session('error') }}
            </div>
        @endif

        {{-- KARTU HEADER --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start gap-6 mb-6">
            
            {{-- LOGO/KALENDER --}}
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex flex-col items-center justify-center text-white font-bold flex-shrink-0 shadow-md">
                <span class="text-2xl leading-none font-black">{{ $event->tanggal->format('d') }}</span>
                <span class="text-[10px] uppercase tracking-widest mt-0.5">{{ $event->tanggal->format('M') }}</span>
            </div>
            
            {{-- INFO UTAMA --}}
            <div class="flex-1 w-full">
                <h1 class="text-2xl font-bold text-gray-900 mb-2.5 tracking-tight">{{ $event->judul }}</h1>
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 font-medium">
                    <span class="flex items-center gap-1.5 bg-gray-50 px-2.5 py-1 rounded-md border border-gray-100">
                        <i class="fas fa-map-marker-alt text-red-400"></i> {{ $event->tempat }}
                    </span>
                    <span class="flex items-center gap-1.5 bg-gray-50 px-2.5 py-1 rounded-md border border-gray-100">
                        <i class="fas fa-clock text-amber-400"></i> {{ $event->jam }} WIB
                    </span>
                    <span class="flex items-center gap-1.5 bg-green-50 text-green-700 px-2.5 py-1 rounded-md border border-green-100 text-[11px] font-bold uppercase tracking-wider">
                        <i class="fas fa-door-open"></i> Terbuka
                    </span>
                </div>
            </div>
            
            {{-- TOMBOL AKSI --}}
            <div class="flex gap-3 mt-4 md:mt-0 w-full md:w-auto">
                
                {{-- TOMBOL SHARE --}}
                <button onclick="shareEvent()" class="w-11 h-11 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-600 transition bg-white shadow-sm flex-shrink-0" title="Bagikan Event">
                    <i class="fas fa-share-alt text-base"></i>
                </button>

                @if($isRegistered)
                    {{-- TOMBOL INTERAKTIF (DIKEMBALIKAN KARENA BACKEND SUDAH DIPERBAIKI) --}}
                    <form action="{{ route('user.events.destroy', $event->id) }}" method="POST" class="w-full md:w-auto flex-1 md:flex-none m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="group w-full md:w-auto bg-green-50 text-green-700 border border-green-200 hover:bg-red-50 hover:text-red-700 hover:border-red-200 px-6 py-2.5 rounded-lg font-bold transition-all duration-300 flex items-center justify-center gap-2 text-sm shadow-sm cursor-pointer" onclick="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran event ini?')">
                            <i class="fas fa-check-circle group-hover:hidden"></i>
                            <i class="fas fa-times-circle hidden group-hover:inline-block"></i>
                            <span class="group-hover:hidden">Sudah Terdaftar</span>
                            <span class="hidden group-hover:inline-block">Batal Daftar</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('user.events.store') }}" method="POST" class="w-full md:w-auto flex-1 md:flex-none m-0">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold transition shadow-sm shadow-blue-200 flex items-center justify-center gap-2 text-sm" onclick="return confirm('Yakin ingin mendaftar ke event ini?')">
                            Daftar Event <i class="fas fa-ticket-alt"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- KONTEN BAWAH --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            
            <div class="md:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h3 class="text-base font-bold text-gray-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                    <i class="fas fa-align-left text-blue-500"></i> Detail & Deskripsi Acara
                </h3>
                <div class="text-gray-600 text-sm leading-relaxed space-y-4 text-justify prose prose-sm max-w-none">
                    {!! nl2br(e($event->deskripsi)) !!}
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h4 class="font-bold text-gray-900 mb-4 text-sm flex items-center gap-2">
                        <i class="fas fa-users text-indigo-500"></i> Partisipasi
                    </h4>
                    <div class="flex items-end gap-2 mb-2">
                        <span class="text-4xl font-black text-gray-800 leading-none">{{ $event->participants->count() }}</span>
                        <span class="text-xs text-gray-500 font-medium mb-1">Orang terdaftar</span>
                    </div>
                    
                    @if($event->participants->count() > 0)
                    <div class="flex -space-x-2 overflow-hidden mt-4 pt-4 border-t border-gray-50">
                        <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">A</div>
                        <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-indigo-100 text-indigo-600 flex items-center justify-center text-[10px] font-bold">B</div>
                        <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 text-gray-600 flex items-center justify-center text-[10px] font-bold">+{{ $event->participants->count() }}</div>
                    </div>
                    @endif
                </div>

                <div class="bg-blue-50/50 rounded-2xl p-6 border border-blue-100">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5">
                            <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-blue-800 font-bold mb-1">Informasi Pendaftaran</p>
                            <p class="text-[11px] text-blue-600/80 leading-relaxed font-medium">Pastikan Anda hadir tepat waktu sesuai jadwal yang tertera. Bawa kartu identitas (KTM/KTP) saat registrasi ulang di lokasi.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function shareEvent() {
        const shareData = {
            title: '{{ $event->judul }}',
            text: 'Yuk ikutan event {{ $event->judul }} di {{ $event->tempat }}!',
            url: window.location.href
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => console.log('Berhasil membagikan event'))
                .catch((error) => console.log('Gagal membagikan', error));
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Browser tidak mendukung Share otomatis. Link event berhasil disalin ke clipboard!');
        }
    }
</script>
@endsection