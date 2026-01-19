@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Networking Alumni</h1>
            <p class="text-gray-500">Temukan teman seangkatan dan bangun relasi profesional.</p>
        </div>

        <form action="{{ route('user.alumni.index') }}" method="GET" class="mb-10 max-w-5xl mx-auto">
            <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-2">
                
                <div class="flex-1 flex items-center px-4 py-2 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-search text-gray-400 mr-3 text-lg"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama alumni atau angkatan..." 
                           class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                </div>

                <div class="w-full md:w-1/3 flex items-center px-4 py-2 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-graduation-cap text-gray-400 mr-3 text-lg"></i>
                    <select name="jurusan" class="w-full bg-transparent outline-none text-gray-700 cursor-pointer appearance-none">
                        <option value="">Semua Jurusan</option>
                        @php
                            $jurusans = ['Informatika', 'Sistem Informasi', 'Bisnis Digital', 'Akuntansi'];
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
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-lg hover:-translate-y-1 transition duration-300 flex flex-col items-center group relative">
                
                <a href="{{ route('user.alumni.show', $a->id) }}" class="flex flex-col items-center w-full">
                    <div class="mb-4 relative">
                        @if($a->Foto)
                            <img src="{{ asset('storage/' . $a->Foto) }}" alt="{{ $a->nama }}" class="w-24 h-24 rounded-full object-cover border-4 border-blue-50 group-hover:border-blue-200 transition shadow-sm">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-3xl font-bold border-4 border-blue-50 group-hover:border-blue-200 transition shadow-sm">
                                {{ substr($a->nama, 0, 2) }}
                            </div>
                        @endif
                        <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-1 truncate w-full group-hover:text-blue-600 transition">{{ $a->nama }}</h3>
                    <p class="text-sm text-blue-600 font-medium mb-1 truncate w-full">{{ $a->program_studi }}</p>
                    <p class="text-xs text-gray-500 mb-4 bg-gray-50 px-2 py-1 rounded-full border border-gray-100">
                        Angkatan {{ $a->angkatan }} • Lulus {{ $a->tahun_lulus }}
                    </p>
                </a>

                <button onclick="toggleConnect(this, '{{ $a->id }}')" 
                        id="btn-connect-{{ $a->id }}"
                        class="w-full py-2 rounded-xl font-bold text-sm transition shadow-sm bg-blue-600 text-white hover:bg-blue-700 active:scale-95">
                    Connect
                </button>

            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-users-slash text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada alumni ditemukan</h3>
                <p class="text-gray-500 text-sm">Coba ubah kata kunci atau filter jurusan.</p>
                <a href="{{ route('user.alumni.index') }}" class="inline-block mt-4 text-blue-600 font-bold hover:underline text-sm">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $alumni->appends(request()->query())->links() }}
        </div>

    </div>

    <div id="toast" class="fixed bottom-8 right-8 bg-gray-900 text-white px-6 py-4 rounded-xl shadow-2xl transform translate-y-32 transition-transform duration-300 flex items-center gap-4 z-50">
        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shrink-0">
            <i class="fas fa-paper-plane text-white text-xs"></i>
        </div>
        <div>
            <h4 class="font-bold text-sm">Permintaan Terkirim</h4>
            <p class="text-xs text-gray-300">Menunggu konfirmasi alumni.</p>
        </div>
    </div>

</div>

<script>
    function toggleConnect(btn, id) {
        let connected = JSON.parse(localStorage.getItem('connected_ids') || '[]');
        
        if (connected.includes(id)) {
            // BATALKAN
            connected = connected.filter(itemId => itemId !== id);
            btn.classList.remove('bg-gray-100', 'text-gray-500');
            btn.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            btn.innerHTML = 'Connect';
        } else {
            // KLIK CONNECT
            connected.push(id);
            btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            btn.classList.add('bg-gray-100', 'text-gray-500', 'cursor-not-allowed');
            btn.innerHTML = '<i class="fas fa-clock mr-1"></i> Pending';
            showToast();
        }
        localStorage.setItem('connected_ids', JSON.stringify(connected));
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('translate-y-32');
        setTimeout(() => toast.classList.add('translate-y-32'), 3000);
    }

    // Load Status
    document.addEventListener('DOMContentLoaded', () => {
        const connected = JSON.parse(localStorage.getItem('connected_ids') || '[]');
        connected.forEach(id => {
            const btn = document.getElementById(`btn-connect-${id}`);
            if (btn) {
                btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                btn.classList.add('bg-gray-100', 'text-gray-500');
                btn.innerHTML = '<i class="fas fa-clock mr-1"></i> Pending';
            }
        });
    });
</script>
@endsection