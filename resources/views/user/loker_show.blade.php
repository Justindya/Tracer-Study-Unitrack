@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-5xl mx-auto px-4">
        
        <a href="{{ route('user.lokers.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium mb-6 transition focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Lowongan
        </a>

        <div class="bg-white rounded-t-2xl p-8 shadow-sm border-b border-gray-100 flex flex-col md:flex-row items-start gap-6">
            <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold flex-shrink-0 shadow-lg shadow-blue-200">
                {{ substr($loker->perusahaan, 0, 2) }}
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $loker->judul }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-building text-blue-500"></i> {{ $loker->perusahaan }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-red-500"></i> {{ $loker->lokasi }}
                    </span>
                </div>
            </div>
            
            <div class="flex gap-3 mt-4 md:mt-0">
                <button id="btn-bookmark" class="w-12 h-12 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-600 transition focus:outline-none group bg-white">
                    <i class="far fa-bookmark text-xl group-hover:fas"></i>
                </button>
                
                <a id="btn-apply" href="mailto:{{ $loker->kontak }}?subject=Lamaran Pekerjaan: {{ $loker->judul }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-blue-200 flex items-center gap-2 focus:outline-none focus:ring-0">
                    Lamar Sekarang <i class="fas fa-paper-plane"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-b-2xl p-8 shadow-sm space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-6 rounded-xl border border-blue-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 shadow-sm">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Tanggal Mulai</p>
                        <p class="text-gray-900 font-semibold">{{ $loker->tanggal_mulai->format('d F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Batas Lamaran</p>
                        <p class="text-gray-900 font-semibold">{{ $loker->tanggal_selesai->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-l-4 border-blue-600 pl-4">Deskripsi Pekerjaan</h3>
                <div class="text-gray-600 leading-relaxed space-y-4 text-justify">
                    {!! nl2br(e($loker->deskripsi)) !!}
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-l-4 border-blue-600 pl-4">Informasi Kontak</h3>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 inline-block">
                    <p class="text-gray-600 text-sm">Kirim CV dan lamaran Anda ke:</p>
                    <p class="text-blue-600 font-bold mt-1 text-lg">{{ $loker->kontak }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Pastikan halaman siap dulu sebelum menjalankan script
    document.addEventListener('DOMContentLoaded', function() {
        
        const jobData = {
            id: "{{ $loker->id }}",
            title: "{{ $loker->judul }}",
            company: "{{ $loker->perusahaan }}",
            location: "{{ $loker->lokasi }}",
            url: "{{ route('user.lokers.show', $loker) }}",
            appliedDate: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
        };

        // --- LOGIKA LAMAR (Simpan ke Lamaran Saya) ---
        const btnApply = document.getElementById('btn-apply');
        if(btnApply){
            btnApply.addEventListener('click', function() {
                let appliedJobs = JSON.parse(localStorage.getItem('appliedJobs')) || [];
                // Cek duplikasi agar tidak double
                if(!appliedJobs.some(job => job.id === jobData.id)) {
                    appliedJobs.push(jobData);
                    localStorage.setItem('appliedJobs', JSON.stringify(appliedJobs));
                }
            });
        }

        // --- LOGIKA BOOKMARK (Simpan ke Bookmark Saya) ---
        const btnBookmark = document.getElementById('btn-bookmark');
        if(btnBookmark){
            // Cek status awal (apakah sudah dibookmark?)
            let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
            if(bookmarks.some(job => job.id === jobData.id)) {
                btnBookmark.innerHTML = '<i class="fas fa-bookmark text-xl text-blue-600"></i>';
            }

            btnBookmark.addEventListener('click', function() {
                bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
                
                if(bookmarks.some(job => job.id === jobData.id)) {
                    // Hapus bookmark
                    bookmarks = bookmarks.filter(job => job.id !== jobData.id);
                    alert('Bookmark dihapus');
                    this.innerHTML = '<i class="far fa-bookmark text-xl"></i>';
                } else {
                    // Tambah bookmark
                    bookmarks.push(jobData);
                    alert('Lowongan berhasil disimpan ke Bookmark!');
                    this.innerHTML = '<i class="fas fa-bookmark text-xl text-blue-600"></i>';
                }
                localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            });
        }
    });
</script>
@endsection