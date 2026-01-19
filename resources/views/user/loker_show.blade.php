@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('user.lokers.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium mb-6 text-sm transition focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Lowongan
        </a>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start gap-6 mb-6">
            <div class="w-20 h-20 bg-blue-600 rounded-xl flex items-center justify-center text-white text-3xl font-bold flex-shrink-0 shadow-md">
                {{ substr($loker->perusahaan, 0, 2) }}
            </div>
            
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $loker->judul }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                    <span class="flex items-center gap-2"><i class="fas fa-building text-blue-500"></i> {{ $loker->perusahaan }}</span>
                    <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-red-500"></i> {{ $loker->lokasi }}</span>
                </div>
            </div>
            
            <div class="flex gap-3 mt-4 md:mt-0 w-full md:w-auto">
                <button id="btn-bookmark" class="w-12 h-12 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-600 transition bg-white shadow-sm">
                    <i class="far fa-bookmark text-xl"></i>
                </button>

                @if(isset($hasApplied) && $hasApplied)
                    <button class="flex-1 md:flex-none bg-green-50 text-green-700 border border-green-200 px-8 py-3 rounded-xl font-bold cursor-default flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-check-circle"></i> Sudah Dilamar
                    </button>
                @else
                    <a id="btn-apply" href="mailto:{{ $loker->kontak }}?subject=Lamaran: {{ $loker->judul }}" class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-md shadow-blue-200 flex items-center justify-center gap-2 text-sm">
                        Lamar Sekarang <i class="fas fa-paper-plane"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-gray-100 h-fit">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">Deskripsi Pekerjaan</h3>
                <div class="text-gray-600 text-sm leading-relaxed space-y-4 text-justify [&>ul]:list-disc [&>ul]:pl-5 [&>ol]:list-decimal [&>ol]:pl-5">
                    {!! $loker->deskripsi !!}
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h4 class="font-bold text-gray-900 mb-4 text-sm">Jadwal</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center text-blue-600"><i class="fas fa-calendar-check text-xs"></i></div>
                            <div><p class="text-[10px] text-gray-400 uppercase font-bold">Mulai</p><p class="text-gray-900 font-semibold text-sm">{{ $loker->tanggal_mulai->format('d M Y') }}</p></div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-50 rounded-full flex items-center justify-center text-red-500"><i class="fas fa-calendar-times text-xs"></i></div>
                            <div><p class="text-[10px] text-gray-400 uppercase font-bold">Deadline</p><p class="text-gray-900 font-semibold text-sm">{{ $loker->tanggal_selesai->format('d M Y') }}</p></div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                    <p class="text-xs text-blue-600 mb-1 font-medium">Kirim lamaran ke:</p>
                    <p class="text-gray-900 font-bold text-sm break-all select-all">{{ $loker->kontak }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- LOGIKA AJAX UNTUK SIMPAN LAMARAN ---
        const btnApply = document.getElementById('btn-apply');
        
        if(btnApply){
            btnApply.addEventListener('click', function(e) {
                // Kita TIDAK preventDefault(), agar window email tetap terbuka.
                // Tapi kita kirim request ke server di background.

                fetch('{{ route("user.lokers.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token wajib Laravel
                    },
                    body: JSON.stringify({
                        loker_id: '{{ $loker->id }}'
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data.message);
                    // Opsional: Refresh halaman setelah 2 detik agar status berubah jadi "Sudah Dilamar"
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch(err => console.error('Gagal mencatat lamaran:', err));
            });
        }

        // --- Bookmark logic (Masih LocalStorage dulu sementara) ---
        const jobData = {
            id: "{{ $loker->id }}",
            title: "{{ $loker->judul }}",
            company: "{{ $loker->perusahaan }}",
            url: "{{ route('user.lokers.show', $loker) }}"
        };
        const btnBookmark = document.getElementById('btn-bookmark');
        if(btnBookmark){
            let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
            if(bookmarks.some(job => job.id === jobData.id)) {
                btnBookmark.innerHTML = '<i class="fas fa-bookmark text-xl text-blue-600"></i>';
            }
            btnBookmark.addEventListener('click', function() {
                bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
                if(bookmarks.some(job => job.id === jobData.id)) {
                    bookmarks = bookmarks.filter(job => job.id !== jobData.id);
                    this.innerHTML = '<i class="far fa-bookmark text-xl"></i>';
                } else {
                    bookmarks.push(jobData);
                    this.innerHTML = '<i class="fas fa-bookmark text-xl text-blue-600"></i>';
                }
                localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            });
        }
    });
</script>
@endsection