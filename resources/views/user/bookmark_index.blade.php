@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-5xl mx-auto px-4">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Bookmark Saya</h1>
            <button id="btn-clear" onclick="clearBookmarks()" class="text-red-500 text-sm hover:underline font-bold hidden">
                Hapus Semua
            </button>
        </div>

        <div id="bookmark-container" class="space-y-4"></div>

        <div id="empty-state" class="hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center flex-col items-center justify-center min-h-[400px]">
            <div class="w-24 h-24 mb-6 text-gray-300">
                <i class="far fa-bookmark text-6xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada bookmark</h3>
            <p class="text-gray-500 mb-8">Simpan lowongan menarik di sini.</p>
            <a href="{{ route('user.lokers.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Cari Lowongan</a>
        </div>

    </div>
</div>

<script>
    function renderBookmarks() {
        // Ambil data dengan aman
        let bookmarks = [];
        try {
            bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
        } catch (e) {
            console.error("Data bookmark rusak, mereset...", e);
            localStorage.removeItem('bookmarks');
        }

        const container = document.getElementById('bookmark-container');
        const emptyState = document.getElementById('empty-state');
        const btnClear = document.getElementById('btn-clear');

        container.innerHTML = ''; // Bersihkan container

        if (bookmarks.length === 0) {
            emptyState.classList.remove('hidden');
            emptyState.classList.add('flex');
            btnClear.classList.add('hidden'); 
        } else {
            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');
            btnClear.classList.remove('hidden');

            bookmarks.forEach(job => {
                // PENGAMAN ERROR: Gunakan default value jika data kosong
                const company = job.company || 'Perusahaan';
                const initial = company.substring(0, 2).toUpperCase();
                const title = job.title || 'Posisi Tidak Diketahui';
                const location = job.location || '-';
                const url = job.url || '#';

                const card = `
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6 relative group hover:shadow-md transition">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-xl flex items-center justify-center text-2xl font-bold flex-shrink-0">
                            ${initial}
                        </div>
                        <div class="flex-1 w-full text-center md:text-left">
                            <h3 class="text-xl font-bold text-blue-600">${title}</h3>
                            <p class="text-gray-800 font-medium">${company}</p>
                            <div class="flex gap-2 mt-2 text-xs text-gray-500 justify-center md:justify-start">
                                <span><i class="fas fa-map-marker-alt"></i> ${location}</span>
                            </div>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <a href="${url}" class="flex-1 md:flex-none text-center bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">
                                Daftar Sekarang
                            </a>
                            <button onclick="removeOne('${job.id}')" class="bg-red-100 text-red-600 px-4 py-2.5 rounded-lg hover:bg-red-200 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }
    }

    function removeOne(id) {
        let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
        bookmarks = bookmarks.filter(job => job.id != id); // Filter data selain ID yg dihapus
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
        renderBookmarks(); // Render ulang
    }

    function clearBookmarks() {
        if(confirm('Hapus semua bookmark?')) {
            localStorage.removeItem('bookmarks');
            location.reload();
        }
    }

    // Jalankan render saat halaman dimuat
    renderBookmarks();
</script>
@endsection