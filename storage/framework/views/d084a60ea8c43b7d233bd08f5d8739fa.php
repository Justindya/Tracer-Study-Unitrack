<?php $__env->startSection('content'); ?>
<div class="py-8 bg-gray-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center sticky top-24">
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full p-[2px] shadow-sm">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                                <?php if(Auth::user()->alumni && Auth::user()->alumni->Foto): ?>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->alumni->Foto)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-2xl font-bold text-gray-700"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-base font-bold text-gray-800 truncate px-2"><?php echo e(Auth::user()->name); ?></h2>
                    <p class="text-gray-500 text-xs mb-6 font-medium">Mahasiswa / Alumni</p>

                    <nav class="space-y-1.5 text-left">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-home w-5 text-center"></i> Overview
                        </a>
                        
                        <a href="<?php echo e(route('user.tracer.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="<?php echo e(route('user.bookmark.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="<?php echo e(route('user.rekomendasi')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            
            <div class="w-full lg:w-3/4 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    
                    <div class="pb-4 mb-6 border-b border-gray-200/60 flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Detail Data Tracer</h1>
                            <p class="text-sm text-gray-500 mt-1 font-medium">Rincian kuesioner pelacakan karir Anda.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-blue-50/50 rounded-lg border border-blue-100">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Status Karir</p>
                                <p class="text-sm font-bold text-blue-700 mt-1 capitalize"><?php echo e(str_replace('_', ' ', $tracer->status)); ?></p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Mulai</p>
                                <p class="text-sm font-semibold text-gray-800 mt-1"><?php echo e($tracer->tanggal_mulai->format('d M Y')); ?></p>
                            </div>
                        </div>

                        <?php
                            $status = $tracer->status;
                            $soalLabels = [
                                'bekerja' => [
                                    'Berapa lama anda mendapatkan pekerjaan?',
                                    'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)?',
                                    'Lokasi Tempat Anda Bekerja (Provinsi)',
                                    'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
                                    'Jenis Perusahaan tempat anda bekerja',
                                    'Nama Perusahaan tempat anda bekerja',
                                    'Kategori perusahaan tempat anda bekerja',
                                    'Informasi yang anda dapatkan untuk mencari pekerjaan',
                                ],
                                'wiraswasta' => [
                                    'Apakah jabatan/posisi anda ketika Berwirausaha?',
                                    'Nama Usaha anda',
                                    'Pendapatan per bulan anda',
                                    'Bidang Usaha',
                                    'Berapa lama anda memulai usaha?',
                                ],
                                'melanjutkan_pendidikan' => [
                                    'Jenjang melanjutkan',
                                    'Nama Perguruan Tinggi',
                                    'Nama Program Studi',
                                    'Tanggal Bulan Tahun Masuk',
                                    'Sumber Biaya',
                                ],
                                'tidak_bekerja' => [
                                    'Berapa perusahaan/instansi yang sudah anda lamar?',
                                    'Berapa banyak respons lamaran anda?',
                                    'Berapa banyak undangan wawancara?',
                                ],
                            ];

                            // Direct Query agar tidak kena Bug Relasi
                            $jawaban = null;
                            if ($status == 'bekerja') $jawaban = \App\Models\bekerja::where('alumni_id', $tracer->alumni_id)->first();
                            elseif ($status == 'wiraswasta') $jawaban = \App\Models\wiraswasta::where('alumni_id', $tracer->alumni_id)->first();
                            elseif ($status == 'melanjutkan_pendidikan') $jawaban = \App\Models\melanjutkan_pendidikan::where('alumni_id', $tracer->alumni_id)->first();
                            elseif ($status == 'tidak_bekerja') $jawaban = \App\Models\tidak_bekerja::where('alumni_id', $tracer->alumni_id)->first();
                        ?>

                        <?php if($jawaban && isset($soalLabels[$status])): ?>
                            <div class="mt-6 border border-gray-100 rounded-lg overflow-hidden">
                                <ul class="divide-y divide-gray-100">
                                    <?php $__currentLoopData = $soalLabels[$status]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="flex flex-col sm:flex-row p-4 hover:bg-gray-50 transition">
                                            <div class="w-full sm:w-1/2">
                                                <span class="text-xs font-bold text-gray-600"><?php echo e($label); ?></span>
                                            </div>
                                            <div class="w-full sm:w-1/2 mt-1 sm:mt-0">
                                                <span class="text-sm font-semibold text-gray-900"><?php echo e($jawaban->{'soal_' . ($i + 1)} ?? '-'); ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <div class="p-4 bg-yellow-50 text-yellow-700 text-sm rounded-lg border border-yellow-100 font-semibold">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Rincian kuesioner belum diisi secara lengkap.
                            </div>
                        <?php endif; ?>

                        
                        <div class="mt-8 pt-5 border-t border-gray-100 flex gap-3">
                            <a href="<?php echo e(route('user.tracer.edit', $tracer->id)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-sm flex items-center gap-2">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <a href="<?php echo e(route('user.tracer.index')); ?>" class="bg-white border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-gray-50 transition shadow-sm text-center">
                                Kembali
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/show.blade.php ENDPATH**/ ?>