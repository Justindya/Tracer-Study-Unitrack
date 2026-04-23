@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen font-sans">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('user.alumni.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Network
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-sm font-medium text-gray-800">{{ $alumni->nama }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-600 relative"></div>
                    
                    <div class="px-6 pb-8 text-center relative">
                        <div class="-mt-16 mb-4 relative inline-block">
                            <div class="w-32 h-32 bg-white rounded-full p-1.5 shadow-lg mx-auto">
                                <div class="w-full h-full bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    @if($alumni->Foto)
                                        <img src="{{ asset('storage/' . $alumni->Foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-4xl font-bold text-gray-400">{{ substr($alumni->nama, 0, 1) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 rounded-full border-2 border-white w-8 h-8 flex items-center justify-center shadow-sm {{ $alumni->tahun_lulus ? 'bg-green-500' : 'bg-blue-500' }}" title="{{ $alumni->tahun_lulus ? 'Alumni' : 'Mahasiswa' }}">
                                <i class="fas {{ $alumni->tahun_lulus ? 'fa-check' : 'fa-user-graduate' }} text-white text-xs"></i>
                            </div>
                        </div>

                        <h1 class="text-xl font-bold text-gray-900 leading-tight mb-1">{{ $alumni->nama }}</h1>
                        <p class="text-blue-600 font-medium text-sm mb-6">{{ $alumni->program_studi }}</p>

                        <div class="flex flex-col gap-3 mb-6">
                            <a href="mailto:{{ $alumni->email }}" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-2.5 px-4 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2">
                                <i class="far fa-envelope text-lg"></i> {{ $alumni->email }}
                            </a>
                            
                            @if($alumni->linkedin)
                                <a href="{{ $alumni->linkedin }}" target="_blank" class="w-full bg-[#0077b5] hover:bg-[#005582] text-white py-2.5 px-4 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shadow-sm">
                                    <i class="fab fa-linkedin text-lg"></i> Kunjungi LinkedIn
                                </a>
                            @else
                                <div class="w-full bg-gray-100 text-gray-400 py-2.5 px-4 rounded-xl text-sm font-medium flex items-center justify-center gap-2 cursor-not-allowed">
                                    <i class="fab fa-linkedin text-lg"></i> LinkedIn Belum Ada
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 text-center">
                            <div>
                                <span class="text-[10px] text-gray-400 uppercase tracking-wider block mb-1">Angkatan</span>
                                <span class="text-gray-800 font-bold text-lg">{{ $alumni->angkatan }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-gray-400 uppercase tracking-wider block mb-1">Status</span>
                                @if($alumni->tahun_lulus == '-' || !$alumni->tahun_lulus)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-blue-50 text-blue-700">
                                        Mahasiswa Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-green-50 text-green-700">
                                        Alumni
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mr-4">
                            <i class="fas fa-user-tag text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Tentang Saya</h3>
                    </div>
                    
                    <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                        @if($alumni->bio)
                            <p class="whitespace-pre-line">{{ $alumni->bio }}</p>
                        @else
                            <p class="italic text-gray-400">Pengguna ini belum menuliskan deskripsi diri.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 mr-4">
                            <i class="fas fa-star text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Skills & Keahlian</h3>
                    </div>
                    
                    <div class="flex flex-wrap gap-2">
                        @if($alumni->skill)
                            @foreach(explode(',', $alumni->skill) as $tag)
                                <span class="px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm font-medium border border-gray-200">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-sm text-gray-400 italic">Belum menambahkan skill.</span>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600 mr-4">
                            <i class="fas fa-graduation-cap text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Pendidikan</h3>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-0.5 bg-gray-200 h-full"></div>
                        </div>
                        <div class="pb-6">
                            <h4 class="text-base font-bold text-gray-900">Universitas (UniTrack)</h4>
                            <p class="text-sm text-blue-600 font-medium">{{ $alumni->program_studi }}</p>
                            <p class="text-xs text-gray-500 mt-1">Masuk: {{ $alumni->angkatan }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection