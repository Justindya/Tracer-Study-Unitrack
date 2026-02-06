<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="mt-3">Detail Data Tracer</h1>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Status</th>
                <td><?php echo e(ucwords($tracer->status)); ?></td>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <td><?php echo e($tracer->tanggal_mulai->format('d/m/Y')); ?></td>
            </tr>
            <?php
                $status = $tracer->status;
                $soalLabels = [
                    'bekerja' => [
                        'Berapa lama anda mendapatkan pekerjaan',
                        'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)',
                        'Lokasi Tempat Anda Bekerja (Provinsi)',
                        'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
                        'Jenis Perusahaan tempat anda bekerja',
                        'Nama Perusahaan tempat anda bekerja',
                        'Kategori perusahaan tempat anda bekerja',
                        'Informasi yang anda dapatkan untuk mencari pekerjaan',
                    ],
                    'wiraswasta' => [
                        'Apakah jabatan/posisi anda ketika Berwirausaha',
                        'Nama Usaha anda',
                        'Pendapatan per bulan anda',
                        'Bidang Usaha',
                        'Berapa lama anda memulai usaha',
                    ],
                    'melanjutkan' => [
                        'Jenjang melanjutkan',
                        'Nama Perguruan Tinggi',
                        'Nama Program Studi',
                        'Tanggal Bulan Tahun Masuk',
                        'Sumber Biaya',
                    ],
                    'tidak bekerja' => [
                        'Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat surat atau e-mail) sebelum anda memeroleh pekerjaan pertama?',
                        'Berapa banyak perusahaan/instansi/institusi yang merespons lamaran anda?',
                        'Berapa banyak perusahaan/instansi/institusi yang mengundang anda untuk wawancara?',
                    ],
                ];
                // Ambil data jawaban sesuai status
                $jawaban = null;
                if ($status == 'bekerja') {
                    $jawaban = $tracer->alumni->bekerja ?? null;
                } elseif ($status == 'wiraswasta') {
                    $jawaban = $tracer->alumni->wiraswasta ?? null;
                } elseif ($status == 'melanjutkan') {
                    $jawaban = $tracer->alumni->melanjutkanPendidikan ?? null;
                } elseif ($status == 'tidak bekerja') {
                    $jawaban = $tracer->alumni->tidakBekerja ?? null;
                }
            ?>

            <?php if($jawaban): ?>
                <?php $__currentLoopData = $soalLabels[$status]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($label); ?></th>
                        <td><?php echo e($jawaban->{'soal_' . ($i + 1)}); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </table>
        <a href="<?php echo e(route('user.tracer.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/show.blade.php ENDPATH**/ ?>