<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-8 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            <a href="<?php echo e(route('user.tracer.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition bg-blue-600 text-white shadow-md shadow-blue-200">
                                <i class="fas fa-folder-open w-4 text-center"></i> Data Tracer
                            </a>
                            <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-blue-50 hover:text-blue-600">
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">Data Karir Alumni</h1>
                                <p class="text-sm text-gray-500">Riwayat data tracer study yang telah Anda isi.</p>
                            </div>
                            <a href="<?php echo e(route('user.tracer.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>

                        <?php if(session('success')): ?>
                            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded-r-lg shadow-sm">
                                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 border border-gray-100 rounded-lg overflow-hidden">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">No</th>
                                        <th class="px-6 py-3">Status Karir</th>
                                        <th class="px-6 py-3">Tanggal Mulai</th>
                                        <th class="px-6 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $tracers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                                            <td class="px-6 py-4"><?php echo e($loop->iteration); ?></td>
                                            <td class="px-6 py-4">
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                    <?php echo e(ucwords(str_replace('_', ' ', $tracer->status))); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                <?php echo e(\Carbon\Carbon::parse($tracer->tanggal_mulai)->format('d M Y')); ?>

                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center gap-2">
                                                    <a href="<?php echo e(route('user.tracer.show', $tracer->id)); ?>" class="text-blue-500 hover:text-blue-700 border border-blue-200 hover:bg-blue-50 p-1.5 rounded transition" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('user.tracer.edit', $tracer->id)); ?>" class="text-yellow-500 hover:text-yellow-700 border border-yellow-200 hover:bg-yellow-50 p-1.5 rounded transition" title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                                                <div class="flex flex-col items-center justify-center">
                                                    <i class="fas fa-folder-open text-3xl mb-2 text-gray-300"></i>
                                                    <p>Belum ada data tracer.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/index.blade.php ENDPATH**/ ?>