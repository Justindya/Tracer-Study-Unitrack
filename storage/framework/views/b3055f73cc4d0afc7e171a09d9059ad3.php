<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Lowongan Kerja & Magang</h1>
            <p class="text-gray-500">Temukan karir impianmu dari mitra perusahaan kami</p>
        </div>
            
        <form action="<?php echo e(route('user.lokers.index')); ?>" method="GET" class="mb-10 w-full">
            <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-2">
                
                <div class="flex-1 flex items-center px-4 py-3 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-search text-gray-400 mr-3 text-lg"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                           placeholder="Cari posisi, perusahaan, atau lokasi..." 
                           class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                </div>

                <div class="w-full md:w-1/4 flex items-center px-4 py-3 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-briefcase text-gray-400 mr-3 text-lg"></i>
                    <select name="tipe" class="w-full bg-transparent outline-none text-gray-700 cursor-pointer appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="Full Time" <?php echo e(request('tipe') == 'Full Time' ? 'selected' : ''); ?>>Full Time</option>
                        <option value="Part Time" <?php echo e(request('tipe') == 'Part Time' ? 'selected' : ''); ?>>Part Time</option>
                        <option value="Internship" <?php echo e(request('tipe') == 'Internship' ? 'selected' : ''); ?>>Internship / Magang</option>
                        <option value="Remote" <?php echo e(request('tipe') == 'Remote' ? 'selected' : ''); ?>>Remote</option>
                    </select>
                    <i class="fas fa-chevron-down text-gray-400 ml-2 text-xs"></i>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-md flex items-center justify-center gap-2">
                    Cari <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <?php if(session('success')): ?>
            <div class="bg-green-50 text-green-700 p-4 mb-6 rounded-xl text-sm flex justify-between items-center border border-green-100 shadow-sm">
                <p><i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?></p>
                <button onclick="this.parentElement.remove()" class="font-bold hover:text-green-900">&times;</button>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $lokers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group flex flex-col justify-between h-full">
                
                <div class="flex items-start gap-5 mb-4">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <?php echo e(substr($loker->perusahaan, 0, 2)); ?>

                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition leading-tight mb-1"><?php echo e($loker->judul); ?></h3>
                        <p class="text-gray-500 font-medium"><?php echo e($loker->perusahaan); ?></p>
                    </div>
                </div>

                <div class="flex items-end justify-between mt-auto pt-4 border-t border-gray-50">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg text-xs font-semibold border border-gray-100">
                            <i class="fas fa-map-marker-alt text-gray-400"></i> <?php echo e($loker->lokasi); ?>

                        </span>
                        <?php if(stripos($loker->judul, 'Intern') !== false || stripos($loker->deskripsi, 'Magang') !== false): ?>
                            <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-600 px-3 py-1.5 rounded-lg text-xs font-semibold border border-purple-100">Internship</span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold border border-blue-100">Full Time</span>
                        <?php endif; ?>
                    </div>
                    
                    <a href="<?php echo e(route('user.lokers.show', $loker)); ?>" class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded-lg font-bold text-sm transition shadow-sm hover:shadow-md">
                        Detail
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-search text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada lowongan ditemukan</h3>
                <p class="text-gray-500 text-sm mb-6">Coba ubah kata kunci atau filter tipe pekerjaan.</p>
                <a href="<?php echo e(route('user.lokers.index')); ?>" class="text-blue-600 font-bold text-sm hover:underline">Reset Filter</a>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-10">
            <?php echo e($lokers->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/loker_index.blade.php ENDPATH**/ ?>