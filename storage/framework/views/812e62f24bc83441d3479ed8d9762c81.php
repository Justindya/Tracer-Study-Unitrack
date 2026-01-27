<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Lowongan Kerja</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Informasi Event
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h4><?php echo e($event->judul); ?></h4>
                <p class="text-muted">
                    <?php echo e($event->tempat); ?>

                </p>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tanggal Event:</strong>
                    <p><?php echo e($event->tanggal->format('d/m/Y')); ?></p>
                </div>
            </div>

            <div class="mb-3">
                <strong>Jam :</strong>
                <p><?php echo e($event->jam); ?></p>
            </div>

            <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p class="mt-2"><?php echo nl2br(e($event->deskripsi)); ?></p>
            </div>


            <div class="mb-3">
                <a href="<?php echo e(route('admin.event.index')); ?>" class="btn btn-secondary">Kembali</a>
                <a href="<?php echo e(route('admin.event.edit', $event)); ?>" class="btn btn-warning">Edit</a>
                <form action="<?php echo e(route('admin.event.destroy', $event)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/event_show.blade.php ENDPATH**/ ?>