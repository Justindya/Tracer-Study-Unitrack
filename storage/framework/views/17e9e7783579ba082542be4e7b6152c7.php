<?php $__env->startSection('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3>Edit Event</h3>
            <form action="<?php echo e(route('admin.event.update', $event->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo e($event->judul); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tempat</label>
                    <input type="text" name="tempat" class="form-control" value="<?php echo e($event->tempat); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo e($event->tanggal); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" value="<?php echo e($event->jam); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required><?php echo e($event->deskripsi); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo e(route('admin.event.index')); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/event_edit.blade.php ENDPATH**/ ?>