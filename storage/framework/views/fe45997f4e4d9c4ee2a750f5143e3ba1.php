<?php $__env->startSection('content'); ?>
<div class="py-8 bg-[#f8fafc] min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center sticky top-24">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="w-full h-full bg-gradient-to-tr from-blue-500 to-indigo-500 rounded-full p-[3px] shadow-md">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                                <?php if(Auth::user()->alumni && Auth::user()->alumni->Foto): ?>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->alumni->Foto)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-3xl font-black text-gray-700"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-lg font-bold text-gray-900 truncate px-2"><?php echo e(Auth::user()->name); ?></h2>
                    <p class="text-gray-500 text-xs mb-6 font-medium tracking-wide">Mahasiswa / Alumni</p>

                    <nav class="space-y-2 text-left">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-home w-5 text-center"></i> Overview
                        </a>
                        
                        <a href="<?php echo e(route('user.tracer.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition bg-blue-50 text-blue-700">
                            <i class="fas fa-clipboard-list w-5 text-center"></i> Data Tracer
                        </a>
                        <a href="<?php echo e(route('user.lamaran.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-briefcase w-5 text-center"></i> Lamaran Saya
                        </a>
                        <a href="<?php echo e(route('user.bookmark.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-bookmark w-5 text-center"></i> Bookmark
                        </a>
                        <a href="<?php echo e(route('user.rekomendasi')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i class="fas fa-star w-5 text-center"></i> Rekomendasi
                        </a>
                    </nav>
                </div>
            </div>

            
            <div class="w-full lg:w-3/4 space-y-6">
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-8">
                    
                    
                    <div class="pb-2 border-b border-gray-200 mb-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Data Tracer</h1>
                        <p class="text-sm text-gray-500 mt-1.5 font-medium">Perbarui data karir Anda yang telah lalu.</p>
                    </div>

                    
                    <?php
                        $rawStatus = $tracer->status;
                        $normStatus = $rawStatus;
                        // Koreksi perbedaan kata dari DB lama
                        if($rawStatus == 'melanjutkan') $normStatus = 'melanjutkan_pendidikan';
                        if($rawStatus == 'tidak bekerja') $normStatus = 'tidak_bekerja';
                    ?>

                    <form action="<?php echo e(route('user.tracer.update', $tracer->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-6">
                            <label for="status" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wide">Status Saat Ini</label>
                            <div class="relative">
                                <select name="status" id="status" class="w-full px-4 py-3 text-sm font-semibold rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none bg-white appearance-none transition cursor-pointer" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="bekerja" <?php echo e(old('status', $normStatus) == 'bekerja' ? 'selected' : ''); ?>>Bekerja (Full Time/Part Time)</option>
                                    <option value="wiraswasta" <?php echo e(old('status', $normStatus) == 'wiraswasta' ? 'selected' : ''); ?>>Wiraswasta / Memiliki Usaha</option>
                                    <option value="melanjutkan_pendidikan" <?php echo e(old('status', $normStatus) == 'melanjutkan_pendidikan' ? 'selected' : ''); ?>>Melanjutkan Pendidikan</option>
                                    <option value="tidak_bekerja" <?php echo e(old('status', $normStatus) == 'tidak_bekerja' ? 'selected' : ''); ?>>Sedang Mencari Pekerjaan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="tanggal_mulai" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wide">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                                   class="w-full px-4 py-3 text-sm font-semibold rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"
                                   value="<?php echo e(old('tanggal_mulai', \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('Y-m-d'))); ?>" required>
                        </div>

                        <div id="soal-form" class="space-y-5 mt-8"></div>

                        
                        <div class="mt-10 flex flex-col sm:flex-row items-center pt-6 border-t border-gray-100 gap-3 justify-end">
                            <a href="<?php echo e(route('user.tracer.index')); ?>" class="w-full sm:w-auto bg-white border border-gray-200 text-gray-700 px-8 py-3 rounded-xl font-bold text-sm hover:bg-gray-50 transition shadow-sm text-center">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-xl font-bold text-sm transition shadow-sm flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const statusQuestions = {
        'bekerja': [
            'Berapa lama anda mendapatkan pekerjaan?',
            'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)?',
            'Lokasi Tempat Anda Bekerja (Provinsi)',
            'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
            'Jenis Perusahaan tempat anda bekerja',
            'Nama Perusahaan tempat anda bekerja',
            'Kategori perusahaan tempat anda bekerja',
            'Informasi yang anda dapatkan untuk mencari pekerjaan'
        ],
        'wiraswasta': [
            'Apakah jabatan/posisi anda ketika Berwirausaha?',
            'Nama Usaha anda',
            'Pendapatan per bulan anda',
            'Bidang Usaha',
            'Berapa lama anda memulai usaha?'
        ],
        'melanjutkan_pendidikan': [
            'Jenjang melanjutkan',
            'Nama Perguruan Tinggi',
            'Nama Program Studi',
            'Tanggal Bulan Tahun Masuk',
            'Sumber Biaya'
        ],
        'tidak_bekerja': [
            'Berapa perusahaan/instansi yang sudah anda lamar?',
            'Berapa banyak respons lamaran anda?',
            'Berapa banyak undangan wawancara?'
        ]
    };

    function renderSoal(status, values = {}) {
        const container = document.getElementById('soal-form');
        container.innerHTML = '';

        if (!status || !statusQuestions[status]) return;

        let headerText = '';
        let headerColor = '';
        if (status === 'bekerja') { headerText = 'Detail Pekerjaan'; headerColor = 'text-blue-600'; }
        else if (status === 'wiraswasta') { headerText = 'Detail Usaha'; headerColor = 'text-green-600'; }
        else if (status === 'melanjutkan_pendidikan') { headerText = 'Detail Pendidikan Lanjutan'; headerColor = 'text-purple-600'; }
        else if (status === 'tidak_bekerja') { headerText = 'Informasi Pencarian Kerja'; headerColor = 'text-amber-600'; }

        container.innerHTML = `
            <div class="bg-gray-50/80 p-6 sm:p-8 rounded-2xl border border-gray-100 mt-2 shadow-sm">
                <h3 class="font-black text-sm ${headerColor} border-b border-gray-200 pb-3 mb-6 uppercase tracking-wider">${headerText}</h3>
                <div id="questions-wrapper" class="space-y-5"></div>
            </div>
        `;

        const wrapper = document.getElementById('questions-wrapper');

        statusQuestions[status].forEach((question, index) => {
            const questionNumber = index + 1;
            const fieldName = `soal_${questionNumber}`;
            const fieldValue = values[fieldName] || '';

            const questionElement = document.createElement('div');
            
            questionElement.innerHTML = `
                <label class="block text-gray-700 text-xs font-bold mb-1.5">${question}</label>
                <input type="text"
                       name="${fieldName}"
                       placeholder="Ketik jawaban Anda..."
                       class="w-full px-4 py-3 text-sm font-semibold rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition shadow-sm"
                       value="${fieldValue.replace(/"/g, '&quot;')}"
                       required>
            `;

            wrapper.appendChild(questionElement);
        });
    }

    document.getElementById('status').addEventListener('change', function() {
        renderSoal(this.value);
    });

    
    <?php
        $initialValues = [];
        $alumniId = Auth::user()->alumni->id ?? $tracer->alumni_id;
        $ans = null;
        
        if (isset($tracer)) {
            if ($normStatus == 'bekerja') $ans = \App\Models\bekerja::where('alumni_id', $alumniId)->first();
            elseif ($normStatus == 'wiraswasta') $ans = \App\Models\wiraswasta::where('alumni_id', $alumniId)->first();
            elseif ($normStatus == 'melanjutkan_pendidikan') $ans = \App\Models\melanjutkan_pendidikan::where('alumni_id', $alumniId)->first();
            elseif ($normStatus == 'tidak_bekerja') $ans = \App\Models\tidak_bekerja::where('alumni_id', $alumniId)->first();
            
            if ($ans) {
                $initialValues = $ans->toArray();
            }
        }

        for ($i = 1; $i <= 8; $i++) {
            $initialValues["soal_$i"] = old("soal_$i", $initialValues["soal_$i"] ?? '');
        }
    ?>

    window.addEventListener('DOMContentLoaded', function() {
        const status = <?php echo json_encode(old('status', $normStatus), 512) ?>;
        const initialValues = <?php echo json_encode($initialValues, 15, 512) ?>;
        if (status) renderSoal(status, initialValues);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/edit.blade.php ENDPATH**/ ?>