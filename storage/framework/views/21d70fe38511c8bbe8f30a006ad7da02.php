<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Soal Kusioner</h1>

    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Kusioner
            <a href="<?php echo e(route('admin.kusioner.create')); ?>" class="btn btn-primary float-end">Tambah Kusioner</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Soal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $kusioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kusioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($kusioner->soal); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.kusioner.show', $kusioner)); ?>" class="btn btn-info btn-sm">
                                    Lihat Jawaban
                                </a>
                                <a href="<?php echo e(route('admin.kusioner.edit', $kusioner)); ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('admin.kusioner.destroy', $kusioner)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($kusioners->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/kusioner_index.blade.php ENDPATH**/ ?>