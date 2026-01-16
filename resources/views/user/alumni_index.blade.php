@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Networking Alumni</h1>
            <p class="text-gray-500">Temukan teman seangkatan dan bangun relasi profesional.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-3/4">
                
                <form action="{{ route('user.alumni.index') }}" method="GET" class="mb-8">
                    <div class="flex gap-4">
                        <div class="flex-1 bg-white p-3 rounded-xl shadow-sm border border-gray-200 flex items-center px-4 focus-within:ring-2 focus-within:ring-blue-100 transition">
                            <i class="fas fa-search text-gray-400 mr-3"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, prodi, atau angkatan..." class="w-full outline-none text-gray-600 bg-transparent">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-md">
                            Cari
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($alumni as $a)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition duration-300 flex flex-col items-center group relative">
                        
                        <a href="{{ route('user.alumni.show', $a->id) }}" class="flex flex-col items-center w-full">
                            <div class="mb-4 relative">
                                @if($a->Foto)
                                    <img src="{{ asset('storage/' . $a->Foto) }}" alt="{{ $a->nama }}" class="w-24 h-24 rounded-full object-cover border-4 border-blue-50 group-hover:border-blue-200 transition">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-blue-600 flex items-center justify-center text-white text-3xl font-bold border-4 border-blue-50 group-hover:border-blue-200 transition">
                                        {{ substr($a->nama, 0, 2) }}
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1 truncate w-full group-hover:text-blue-600 transition">{{ $a->nama }}</h3>
                            <p class="text-sm text-blue-600 font-medium mb-1 truncate w-full">{{ $a->program_studi }}</p>
                            <p class="text-xs text-gray-500 mb-6">Angkatan {{ $a->angkatan }} • Lulus {{ $a->tahun_lulus }}</p>
                        </a>

                        <button onclick="toggleConnect(this, '{{ $a->id }}')" 
                                id="btn-connect-{{ $a->id }}"
                                class="w-full py-2.5 rounded-lg font-bold text-sm transition shadow-sm bg-blue-600 text-white hover:bg-blue-700">
                            Connect
                        </button>

                    </div>
                    @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                        <div class="text-gray-300 mb-4"><i class="fas fa-users-slash text-6xl"></i></div>
                        <p class="text-gray-500 text-lg">Belum ada data alumni ditemukan.</p>
                        <p class="text-gray-400 text-sm">Coba cari kata kunci lain atau kosongkan pencarian.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $alumni->appends(request()->query())->links() }}
                </div>

            </div>

            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 text-lg border-b pb-2">Jurusan</h3>
                    
                    <div class="space-y-2">
                        <a href="{{ route('user.alumni.index') }}" class="block px-4 py-2 rounded-lg {{ !request('jurusan') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            Semua Jurusan
                        </a>
                        @php
                            $jurusans = ['Informatika', 'Sistem Informasi', 'Bisnis Digital', 'Akuntansi'];
                        @endphp
                        @foreach($jurusans as $j)
                        <a href="{{ route('user.alumni.index', ['jurusan' => $j]) }}" class="block px-4 py-2 rounded-lg {{ request('jurusan') == $j ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            {{ $j }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="toast" class="fixed bottom-5 right-5 bg-gray-900 text-white px-6 py-4 rounded-xl shadow-2xl transform translate-y-24 transition-transform duration-300 flex items-center gap-3 z-50">
        <i class="fas fa-check-circle text-green-400 text-xl"></i>
        <div>
            <h4 class="font-bold text-sm">Permintaan Terkirim</h4>
            <p class="text-xs text-gray-400">Menunggu konfirmasi alumni.</p>
        </div>
    </div>

</div>

<script>
    function toggleConnect(btn, id) {
        // Cek status localstorage
        let connected = JSON.parse(localStorage.getItem('connected_ids') || '[]');
        
        if (connected.includes(id)) {
            // BATALKAN CONNECT
            connected = connected.filter(itemId => itemId !== id);
            
            // Ubah Tampilan Tombol
            btn.classList.remove('bg-gray-100', 'text-gray-500');
            btn.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            btn.innerText = 'Connect';
            
        } else {
            // KLIK CONNECT
            connected.push(id);
            
            // Ubah Tampilan Tombol
            btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            btn.classList.add('bg-gray-100', 'text-gray-500');
            btn.innerText = 'Pending';
            
            // Tampilkan Toast
            showToast();
        }
        
        localStorage.setItem('connected_ids', JSON.stringify(connected));
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('translate-y-24'); // Muncul
        setTimeout(() => {
            toast.classList.add('translate-y-24'); // Hilang setelah 3 detik
        }, 3000);
    }

    // LOAD STATUS SAAT HALAMAN DIBUKA
    document.addEventListener('DOMContentLoaded', () => {
        const connected = JSON.parse(localStorage.getItem('connected_ids') || '[]');
        
        connected.forEach(id => {
            const btn = document.getElementById(`btn-connect-${id}`);
            if (btn) {
                btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                btn.classList.add('bg-gray-100', 'text-gray-500');
                btn.innerText = 'Pending';
            }
        });
    });
</script>
@endsection