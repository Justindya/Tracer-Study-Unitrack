<?php $__env->startSection('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3>Data Event</h3>
            <table class="table table-striped">
                <a class="btn btn-primary mb-3 mt-3" href="<?php echo e(route('admin.event.create')); ?>">Tambah Event</a>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Judul</th>
                        <th>Tempat</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->judul); ?></td>
                            <td><?php echo e($item->tempat); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.event.show', $item->id)); ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="<?php echo e(route('admin.event.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?php echo e(route('admin.event.destroy', $item->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/event_index.blade.php ENDPATH**/ ?>