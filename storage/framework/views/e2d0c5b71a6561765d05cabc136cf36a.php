<?php $__env->startSection('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Data Alumni</h3>
                <div>
                    <a class="btn btn-success me-2" href="<?php echo e(route('admin.alumni.export.all')); ?>">
                        <i class="fas fa-file-excel"></i> Export Semua Alumni
                    </a>
                    <a class="btn btn-primary" href="<?php echo e(route('admin.alumni.create')); ?>">Tambah Alumni</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Jenis Kelamin</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $alumnis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->nim); ?></td>
                            <td><?php echo e($item->nama); ?></td>
                            <td><?php echo e($item->program_studi); ?></td>
                            <td><?php echo e($item->jenis_kelamin); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.alumni.show', $item->id)); ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?php echo e(route('admin.alumni.edit', $item->id)); ?>"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?php echo e(route('admin.alumni.destroy', $item->id)); ?>" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/alumni_index.blade.php ENDPATH**/ ?>