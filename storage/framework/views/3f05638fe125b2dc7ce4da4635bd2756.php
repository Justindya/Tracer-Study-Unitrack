

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-6">
            
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-xl shadow-sm p-5 text-center sticky top-24 border border-gray-100">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-600 text-2xl font-bold border-4 border-blue-50 shadow-sm">
                        <?php echo e(substr(Auth::user()->name, 0, 1)); ?> 
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 truncate"><?php echo e(Auth::user()->name); ?></h2>
                    <p class="text-gray-500 text-xs mb-5">Mahasiswa / Alumni</p>

                    <div class="space-y-1 text-left">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-th-large w-4 text-center"></i> Overview
                        </a>
                        <a href="<?php echo e(route('user.tracer.create')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-edit w-4 text-center"></i> Update Tracer
                        </a>
                        <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition bg-blue-600 text-white shadow-md shadow-blue-200">
                            <i class="fas fa-file-alt w-4 text-center"></i> Lamaran Saya
                        </a>
                        <a href="<?php echo e(route('user.bookmark.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-bookmark w-4 text-center"></i> Bookmark
                        </a>
                        <a href="<?php echo e(route('user.rekomendasi')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-magic w-4 text-center"></i> Rekomendasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-3/4">
                <div class="mb-6 border-b border-gray-200 pb-4 flex justify-between items-end">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Riwayat Lamaran</h1>
                        <p class="text-sm text-gray-500 mt-1">Status lamaran kerja yang Anda kirim.</p>
                    </div>
                </div>

                <?php if($lamarans->count() > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php $__currentLoopData = $lamarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition duration-300 group flex flex-col items-start gap-3 h-full">
                            <div class="flex items-center gap-4 w-full">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-lg font-bold flex-shrink-0">
                                    <?php echo e(substr($history->loker->perusahaan ?? '?', 0, 2)); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-bold text-gray-900 truncate group-hover:text-blue-600 transition">
                                        <?php echo e($history->loker->judul ?? 'Lowongan Dihapus'); ?>

                                    </h3>
                                    <p class="text-xs text-gray-500 font-medium truncate">
                                        <?php echo e($history->loker->perusahaan ?? '-'); ?>

                                    </p>
                                </div>
                            </div>
                            
                            <div class="w-full pt-3 mt-auto border-t border-gray-50 flex justify-between items-center">
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-2 py-1 rounded text-[10px] font-bold border border-green-100 capitalize">
                                    <i class="fas fa-check-circle"></i> <?php echo e($history->status); ?>

                                </span>
                                <?php if($history->loker): ?>
                                    <a href="<?php echo e(route('user.lokers.show', $history->loker->id)); ?>" class="text-xs font-bold text-blue-600 hover:underline">Detail</a>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400">Tidak Tersedia</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <i class="far fa-file-alt text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada lamaran</h3>
                        <p class="text-gray-500 text-sm mb-4">Ayo mulai karirmu sekarang.</p>
                        <a href="<?php echo e(route('user.lokers.index')); ?>" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-bold text-xs hover:bg-blue-700 transition">Cari Lowongan</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/lamaran_index.blade.php ENDPATH**/ ?>