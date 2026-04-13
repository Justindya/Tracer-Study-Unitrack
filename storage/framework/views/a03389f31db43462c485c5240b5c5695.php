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
                        
                        <a href="<?php echo e(route('user.tracer.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="<?php echo e(route('user.bookmark.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="<?php echo e(route('user.rekomendasi')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            
            <div class="w-full lg:w-3/4 space-y-6">
                
                
                <div class="pb-1 border-b border-gray-200/60 mb-4 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Data Karir Alumni</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Riwayat data tracer study yang telah Anda isi.</p>
                    </div>
                    <div class="flex gap-2 pb-1">
                        <a href="<?php echo e(route('user.tracer.cv')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-indigo-700 transition shadow-sm flex items-center gap-2">
                            <i class="fas fa-file-pdf"></i> Download CV ATS
                        </a>
                        <a href="<?php echo e(route('user.tracer.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="p-3.5 bg-green-50 border border-green-200 text-green-700 text-sm font-semibold rounded-xl shadow-sm flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 font-bold tracking-wider">No</th>
                                    <th class="px-6 py-4 font-bold tracking-wider">Status Karir</th>
                                    <th class="px-6 py-4 font-bold tracking-wider">Tanggal Mulai</th>
                                    <th class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php $__empty_1 = true; $__currentLoopData = $tracers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-blue-50/30 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($loop->iteration); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="bg-blue-50 text-blue-700 text-[10px] font-semibold px-2 py-1 rounded border border-blue-100 uppercase tracking-wider">
                                                <?php echo e(str_replace('_', ' ', $tracer->status)); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            <?php echo e(\Carbon\Carbon::parse($tracer->tanggal_mulai)->format('d M Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center gap-2">
                                                <a href="<?php echo e(route('user.tracer.show', $tracer->id)); ?>" class="text-gray-400 hover:text-blue-600 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 w-8 h-8 rounded-lg flex items-center justify-center transition shadow-sm" title="Lihat Detail">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                                <a href="<?php echo e(route('user.tracer.edit', $tracer->id)); ?>" class="text-gray-400 hover:text-yellow-600 bg-gray-50 hover:bg-yellow-50 border border-gray-200 hover:border-yellow-200 w-8 h-8 rounded-lg flex items-center justify-center transition shadow-sm" title="Edit Data">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </a>
                                                <form action="<?php echo e(route('user.tracer.destroy', $tracer->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini secara permanen?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-gray-400 hover:text-red-600 bg-gray-50 hover:bg-red-50 border border-gray-200 hover:border-red-200 w-8 h-8 rounded-lg flex items-center justify-center transition shadow-sm" title="Hapus Data">
                                                        <i class="fas fa-trash-alt text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-gray-100">
                                                <i class="fas fa-folder-open text-xl text-gray-400"></i>
                                            </div>
                                            <h3 class="text-sm font-bold text-gray-800 mb-1">Belum ada data tracer</h3>
                                            <p class="text-gray-500 text-xs">Isi data Tracer untuk bisa mencetak CV ATS.</p>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/index.blade.php ENDPATH**/ ?>