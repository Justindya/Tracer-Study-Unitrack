<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Event</h1>
        <a href="<?php echo e(route('admin.event.index')); ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white font-bold text-primary">
            <i class="fas fa-info-circle me-1"></i> Informasi Event
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h2 class="h4 fw-bold text-dark"><?php echo e($event->judul); ?></h2>
                <span class="badge bg-info text-dark"><i class="fas fa-map-marker-alt"></i> <?php echo e($event->tempat); ?></span>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong class="text-muted small">TANGGAL</strong>
                    <p class="fw-bold"><?php echo e($event->tanggal->format('d F Y')); ?></p>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted small">WAKTU</strong>
                    <p class="fw-bold"><?php echo e($event->jam); ?> WIB</p>
                </div>
            </div>

            <div class="mb-4">
                <strong class="text-muted small">DESKRIPSI</strong>
                <div class="p-3 bg-light rounded mt-1 border">
                    <?php echo nl2br(e($event->deskripsi)); ?>

                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="<?php echo e(route('admin.event.edit', $event)); ?>" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Edit Event
                </a>
                <form action="<?php echo e(route('admin.event.destroy', $event)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white font-bold text-success d-flex justify-content-between align-items-center">
            <span><i class="fas fa-users me-1"></i> Pendaftar Event (<?php echo e($event->participants->count()); ?>)</span>
            <button class="btn btn-sm btn-outline-success" onclick="window.print()">Cetak Absensi</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Peserta</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $event->participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4"><?php echo e($loop->iteration); ?></td>
                                <td class="fw-bold">
                                    <?php echo e($user->name); ?>

                                    <?php if($user->alumni): ?>
                                        <span class="badge bg-secondary ms-1" style="font-size: 0.6em;">Alumni <?php echo e($user->alumni->angkatan); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->nim); ?></td>
                                <td><?php echo e($user->alumni->program_studi ?? '-'); ?></td>
                                <td class="text-muted small">
                                    <?php echo e(\Carbon\Carbon::parse($user->pivot->created_at)->format('d/m/Y H:i')); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3 d-block opacity-25"></i>
                                    Belum ada peserta yang mendaftar.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/event_show.blade.php ENDPATH**/ ?>