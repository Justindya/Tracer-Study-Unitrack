<?php $__env->startSection('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3>Edit Alumni</h3>
            <form action="<?php echo e(route('admin.alumni.update', $alumni->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo e($alumni->nama); ?>" required>
                </div>
                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?php echo e($alumni->nim); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo e($alumni->email); ?>" required>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?php echo e($alumni->no_hp); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Angkatan</label>
                    <input type="text" name="angkatan" class="form-control" value="<?php echo e($alumni->angkatan); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tahun Lulus</label>
                    <input type="text" name="tahun_lulus" class="form-control" value="<?php echo e($alumni->tahun_lulus); ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label>Program Studi</label>
                    <select name="program_studi" class="form-control" required>
                        <option value="DIII - Akutansi" <?php echo e($alumni->program_studi == 'DIII - Akutansi' ? 'selected' : ''); ?>>
                            DIII - Akutansi</option>
                        <option value="DIII - Teknik Mesin"
                            <?php echo e($alumni->program_studi == 'DIII - Teknik Mesin' ? 'selected' : ''); ?>>DIII - Teknik Mesin
                        </option>
                        <option value="DIII - Teknik Komputer"
                            <?php echo e($alumni->program_studi == 'DIII - Teknik Komputer' ? 'selected' : ''); ?>>DIII - Teknik
                            Komputer</option>
                        <option value="DIII - Teknik Elerektronika"
                            <?php echo e($alumni->program_studi == 'DIII - Teknik Elerektronika' ? 'selected' : ''); ?>>DIII - Teknik
                            Elerektronika</option>
                        <option value="DIII - Mekanik Otomotif"
                            <?php echo e($alumni->program_studi == 'DIII - Mekanik Otomotif' ? 'selected' : ''); ?>>DIII - Mekanik
                            Otomotif</option>
                        <option value="DIII - Alat Berat"
                            <?php echo e($alumni->program_studi == 'DIII - Alat Berat' ? 'selected' : ''); ?>>DIII - Alat Berat
                        </option>
                        <option value="DIII - Teknik Kimia"
                            <?php echo e($alumni->program_studi == 'DIII - Teknik Kimia' ? 'selected' : ''); ?>>DIII - Teknik
                            Kimia(industri)</option>
                        <option value="DIII - Rekam Medik & Informasi Kesehatan"
                            <?php echo e($alumni->program_studi == 'DIII - Rekam Medik & Informasi Kesehatan' ? 'selected' : ''); ?>>
                            DIII - Rekam Medik & Informasi Kesehatan</option>
                        <option value="DIV - Teknik Informatika"
                            <?php echo e($alumni->program_studi == 'DIV - Teknik Informatika' ? 'selected' : ''); ?>>DIV - Teknik
                            Informatika</option>
                        <option value="DIV - Mekanik Industri Dan Desain"
                            <?php echo e($alumni->program_studi == 'DIV - Mekanik Industri Dan Desain' ? 'selected' : ''); ?>>DIV -
                            Mekanik Industri Dan Desain</option>
                        <option value="DIV - Mekatronika"
                            <?php echo e($alumni->program_studi == 'DIV - Mekatronika' ? 'selected' : ''); ?>>DIV - Mekatronika
                        </option>
                        <option value="DIV - Komputer Akutansi"
                            <?php echo e($alumni->program_studi == 'DIV - Komputer Akutansi' ? 'selected' : ''); ?>>DIV - Komputer
                            Akutansi</option>
                        <option value="DIV - Teknik Otomasi"
                            <?php echo e($alumni->program_studi == 'DIV - Teknik Otomasi' ? 'selected' : ''); ?>>DIV - Teknik
                            Otomasi(industri)</option>
                        <option value="DIV - Kontruksi Bangunan"
                            <?php echo e($alumni->program_studi == 'DIV - Kontruksi Bangunan' ? 'selected' : ''); ?>>DIV - Kontruksi
                            Bangunan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="laki-laki" <?php echo e($alumni->jenis_kelamin == 'laki-laki' ? 'selected' : ''); ?>>Laki-laki
                        </option>
                        <option value="perempuan" <?php echo e($alumni->jenis_kelamin == 'perempuan' ? 'selected' : ''); ?>>Perempuan
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?php echo e($alumni->alamat); ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Foto</label>
                    <?php if($alumni->Foto): ?>
                        <img src="<?php echo e(asset('storage/' . $alumni->Foto)); ?>" width="100" class="d-block mb-2">
                    <?php endif; ?>
                    <input type="file" name="Foto" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('admin.alumni.index')); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/alumni_edit.blade.php ENDPATH**/ ?>