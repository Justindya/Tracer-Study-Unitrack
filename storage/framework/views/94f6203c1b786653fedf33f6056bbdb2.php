<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Event Kampus</h1>
            <p class="text-gray-500">Ikuti kegiatan seru untuk pengembangan karirmu</p>
        </div>

        <form action="<?php echo e(route('user.events.index')); ?>" method="GET" class="mb-10 w-full">
            <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-2">
                <div class="flex-1 flex items-center px-4 py-3 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-search text-gray-400 mr-3 text-lg"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                           placeholder="Cari nama event atau lokasi..." 
                           class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                </div>
                <div class="w-full md:w-1/4 flex items-center px-4 py-3 bg-gray-50 rounded-xl border border-transparent focus-within:bg-white focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                    <i class="fas fa-filter text-gray-400 mr-3 text-lg"></i>
                    <select name="kategori" class="w-full bg-transparent outline-none text-gray-700 cursor-pointer appearance-none">
                        <option value="">Semua Kategori</option>
                        <option value="Job Fair" <?php echo e(request('kategori') == 'Job Fair' ? 'selected' : ''); ?>>Job Fair</option>
                        <option value="Webinar" <?php echo e(request('kategori') == 'Webinar' ? 'selected' : ''); ?>>Webinar</option>
                        <option value="Seminar" <?php echo e(request('kategori') == 'Seminar' ? 'selected' : ''); ?>>Seminar</option>
                        <option value="Workshop" <?php echo e(request('kategori') == 'Workshop' ? 'selected' : ''); ?>>Workshop</option>
                    </select>
                    <i class="fas fa-chevron-down text-gray-400 ml-2 text-xs"></i>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-md flex items-center justify-center gap-2">
                    Cari <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <?php if($events->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 flex flex-col md:flex-row items-center gap-6 group h-full">
                    
                    <div class="bg-blue-50 text-blue-600 rounded-xl w-24 h-24 flex flex-col items-center justify-center flex-shrink-0 border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition duration-300 shadow-sm">
                        <span class="text-3xl font-bold block leading-none"><?php echo e($event->tanggal->format('d')); ?></span>
                        <span class="text-xs font-bold uppercase mt-1"><?php echo e($event->tanggal->format('M')); ?></span>
                    </div>

                    <div class="flex-1 text-left w-full">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition"><?php echo e($event->judul); ?></h3>
                        
                        <div class="space-y-1 text-sm text-gray-500 font-medium">
                            <p class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-gray-400 w-4"></i> <?php echo e($event->tempat); ?>

                            </p>
                            <p class="flex items-center gap-2">
                                <i class="fas fa-clock text-gray-400 w-4"></i> <?php echo e($event->jam); ?> WIB
                            </p>
                        </div>
                    </div>

                    <div class="w-full md:w-auto mt-4 md:mt-0">
                        <a href="<?php echo e(route('user.events.show', $event->id)); ?>" class="block w-full md:w-auto bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded-lg font-bold text-sm text-center transition shadow-sm">
                            Lihat Detail
                        </a>
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-10">
                <?php echo e($events->appends(request()->query())->links()); ?>

            </div>

        <?php else: ?>
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="far fa-calendar-times text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada event ditemukan</h3>
                <p class="text-gray-500 text-sm mb-6">Coba ubah kata kunci atau kategori lain.</p>
                <a href="<?php echo e(route('user.events.index')); ?>" class="text-blue-600 font-bold text-sm hover:underline">Reset Filter</a>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/event_index.blade.php ENDPATH**/ ?>