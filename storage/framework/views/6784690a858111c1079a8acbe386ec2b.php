

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center sticky top-24">
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full p-[2px] shadow-sm">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                                <?php if(Auth::user()->alumni && Auth::user()->alumni->Foto): ?>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->alumni->Foto)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-2xl font-bold text-gray-700"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-base font-bold text-gray-800 truncate px-2"><?php echo e(Auth::user()->name); ?></h2>
                    <p class="text-gray-500 text-xs mb-6 font-medium">Mahasiswa / Alumni</p>

                    <nav class="space-y-1.5 text-left">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-home w-5 text-center"></i> Overview
                        </a>
                        <a href="<?php echo e(route('user.tracer.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        
                        <a href="<?php echo e(route('user.bookmark.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="<?php echo e(route('user.rekomendasi')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            
            <div class="w-full lg:w-3/4 space-y-6">
                
                
                <div class="pb-1 border-b border-gray-200/60 mb-4 flex justify-between items-end gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Bookmark Saya</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Lowongan yang Anda simpan.</p>
                    </div>
                    <button id="btn-clear" onclick="clearBookmarks()" class="hidden text-red-500 text-xs font-bold hover:bg-red-50 px-3 py-1.5 rounded-lg transition border border-red-100 mb-1">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Semua
                    </button>
                </div>

                <div id="bookmark-container" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>

                <div id="empty-state" class="hidden bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
                    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                        <i class="far fa-bookmark text-xl text-gray-400"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-1">Belum ada bookmark</h3>
                    <p class="text-gray-500 text-sm mb-5 max-w-sm mx-auto">Simpan lowongan favoritmu di sini.</p>
                    <a href="<?php echo e(route('user.lokers.index')); ?>" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold text-xs hover:bg-blue-700 transition shadow-sm">Cari Lowongan</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function renderBookmarks() {
        let bookmarks = [];
        try { bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || []; } catch (e) {}

        const container = document.getElementById('bookmark-container');
        const emptyState = document.getElementById('empty-state');
        const btnClear = document.getElementById('btn-clear');

        container.innerHTML = '';

        if (bookmarks.length === 0) {
            emptyState.classList.remove('hidden');
            btnClear.classList.add('hidden'); 
        } else {
            btnClear.classList.remove('hidden');
            bookmarks.forEach(job => {
                const card = `
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow transition duration-200 flex flex-col items-start gap-3 h-full">
                        <div class="flex items-center gap-4 w-full">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg font-bold flex-shrink-0 border border-blue-100">
                                ${job.company.substring(0, 2).toUpperCase()}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-gray-800 truncate transition hover:text-blue-600">${job.title}</h3>
                                <p class="text-xs text-gray-500 font-medium truncate mt-0.5">${job.company}</p>
                            </div>
                        </div>
                        
                        <div class="w-full pt-3 mt-auto border-t border-gray-50 flex justify-between items-center">
                            <button onclick="removeOne('${job.id}')" class="text-xs text-red-500 hover:text-red-700 font-medium flex items-center gap-1 transition">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                            <a href="${job.url}" class="text-xs font-semibold text-blue-600 hover:underline">Lihat Detail</a>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }
    }

    function removeOne(id) {
        let bookmarks = JSON.parse(localStorage.getItem('bookmarks')) || [];
        bookmarks = bookmarks.filter(job => job.id != id);
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
        renderBookmarks();
    }

    function clearBookmarks() {
        if(confirm('Hapus semua bookmark?')) {
            localStorage.removeItem('bookmarks');
            renderBookmarks();
        }
    }
    renderBookmarks();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/bookmark_index.blade.php ENDPATH**/ ?>