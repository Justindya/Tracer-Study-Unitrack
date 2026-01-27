<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Lowongan Kerja</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle me-1"></i>
                Informasi alumni
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Lengkap:</strong>
                        <p><?php echo e($alumni->nama); ?></p>
                    </div>
                    <div class="col-md-6">
                        <strong>NIM:</strong>
                        <p><?php echo e($alumni->nim); ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p><?php echo e($alumni->email); ?></p>
                    </div>
                    <div class="col-md-6">
                        <strong>No HP:</strong>
                        <p><?php echo e($alumni->no_hp); ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Angkatan:</strong>
                        <p><?php echo e($alumni->angkatan); ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tahun Lulus:</strong>
                        <p><?php echo e($alumni->tahun_lulus); ?></p>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Program Studi :</strong>
                    <p><?php echo e($alumni->program_studi); ?></p>
                </div>

                <div class="mb-3">
                    <strong>Jenis Kelamin :</strong>
                    <p><?php echo e($alumni->jenis_kelamin); ?></p>
                </div>

                <div class="mb-3">
                    <strong>Deskripsi:</strong>
                    <p class="mt-2"><?php echo nl2br(e($alumni->alamat)); ?></p>
                </div>
                <div class="mb-3">
                    <strong>Foto:</strong>
                    <?php if($alumni->Foto): ?>
                        <img src="<?php echo e(asset('storage/' . $alumni->Foto)); ?>" width="200" class="d-block mb-2">
                    <?php else: ?>
                        <p>Tidak ada foto</p>
                    <?php endif; ?>
                </div>


                <div class="mb-3">
                    <a href="<?php echo e(route('admin.alumni.index')); ?>" class="btn btn-secondary">Kembali</a>
                    <a href="<?php echo e(route('admin.alumni.export.single', $alumni->id)); ?>" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Data Alumni
                    </a>
                    <a href="<?php echo e(route('admin.alumni.edit', $alumni)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('admin.alumni.destroy', $alumni)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/alumni_show.blade.php ENDPATH**/ ?>