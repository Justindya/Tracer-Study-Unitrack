<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Data Tracer Study</h1>
            <div class="mt-4">
                <a href="<?php echo e(route('admin.tracer.export.all')); ?>" class="btn btn-success me-2">
                    <i class="fas fa-file-excel"></i> Export Data Tracer
                </a>
                <a href="<?php echo e(route('admin.tracer.create')); ?>" class="btn btn-primary">
                    Tambah Tracer
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Mulai
                        </th>
                        
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $tracers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($tracer->alumni->nama ?? 'N/A'); ?></div>
                                <div class="text-sm text-gray-500"><?php echo e($tracer->alumni->nim ?? 'N/A'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e(ucwords($tracer->status)); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?php echo e($tracer->tanggal_mulai->format('d/m/Y')); ?></td>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="<?php echo e(route('admin.tracer.show', $tracer)); ?>" class="btn btn-info">Detail</a>
                                    <a href="<?php echo e(route('admin.tracer.edit', $tracer)); ?>" class="btn btn-warning">Edit</a>
                                    <form action="<?php echo e(route('admin.tracer.destroy', $tracer)); ?>" method="POST"
                                        class="mb-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data tracer</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($tracers->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/tracer_index.blade.php ENDPATH**/ ?>