<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="<?php echo e(route('user.events.index')); ?>" class="inline-flex items-center text-gray-500 hover:text-blue-600 font-medium mb-6 text-sm transition focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Event
        </a>

        <div class="bg-white rounded-xl p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start gap-8 mb-6">
            
            <div class="w-24 h-24 bg-blue-600 rounded-2xl flex flex-col items-center justify-center text-white flex-shrink-0 shadow-lg shadow-blue-200">
                <span class="text-4xl font-bold leading-none"><?php echo e($event->tanggal->format('d')); ?></span>
                <span class="text-sm font-bold uppercase mt-1"><?php echo e($event->tanggal->format('M')); ?></span>
            </div>
            
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900 mb-3"><?php echo e($event->judul); ?></h1>
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <span class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                        <i class="fas fa-map-marker-alt text-red-500"></i> <?php echo e($event->tempat); ?>

                    </span>
                    <span class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                        <i class="fas fa-clock text-yellow-500"></i> <?php echo e($event->jam); ?> WIB
                    </span>
                </div>
            </div>
            
            <div class="w-full md:w-auto mt-4 md:mt-0">
                <a href="#" onclick="alert('Fitur pendaftaran akan segera dibuka!')" class="block w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-xl font-bold text-center transition shadow-lg shadow-blue-200 transform hover:-translate-y-0.5">
                    Daftar Event <i class="fas fa-ticket-alt ml-2"></i>
                </a>
                <p class="text-xs text-gray-400 text-center mt-2">Kuota terbatas!</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-2 bg-white rounded-xl p-8 shadow-sm border border-gray-100 h-fit">
                <h3 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
                    <i class="fas fa-align-left text-blue-500"></i> Deskripsi Acara
                </h3>
                <div class="text-gray-600 leading-relaxed text-justify space-y-4">
                    <?php echo nl2br(e($event->deskripsi)); ?>

                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-blue-600 text-white rounded-xl p-6 shadow-lg shadow-blue-200">
                    <h4 class="font-bold text-lg mb-2">Butuh Bantuan?</h4>
                    <p class="text-blue-100 text-sm mb-4">Hubungi panitia jika ada pertanyaan seputar event ini.</p>
                    <a href="mailto:panitia@kampus.ac.id" class="inline-block bg-white text-blue-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-blue-50 transition w-full text-center">
                        Hubungi Panitia
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/event_show.blade.php ENDPATH**/ ?>