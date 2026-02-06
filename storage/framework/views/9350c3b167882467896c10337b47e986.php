<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Data Tracer</h1>
                <a href="<?php echo e(route('admin.tracer.show', $tracer)); ?>"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-2">
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="<?php echo e(route('admin.tracer.update', $tracer)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-4">
                        <label for="alumni_id" class="block text-sm font-medium text-gray-700 mb-2">Alumni</label>
                        <select name="alumni_id" id="alumni_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['alumni_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                            <option value="">Pilih Alumni</option>
                            <?php $__currentLoopData = $alumni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($alum->id); ?>"
                                    <?php echo e(old('alumni_id', $tracer->alumni_id) == $alum->id ? 'selected' : ''); ?>>
                                    <?php echo e($alum->nama); ?> - <?php echo e($alum->nim); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['alumni_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required>
                            <option value="">Pilih Status</option>
                            <option value="bekerja"
                                <?php echo e(old('status', $tracer->status ?? '') == 'bekerja' ? 'selected' : ''); ?>>Bekerja</option>
                            <option value="wiraswasta"
                                <?php echo e(old('status', $tracer->status ?? '') == 'wiraswasta' ? 'selected' : ''); ?>>Wiraswasta
                            </option>
                            <option value="melanjutkan_pendidikan"
                                <?php echo e(old('status', $tracer->status ?? '') == 'melanjutkan_pendidikan' ? 'selected' : ''); ?>>
                                Melanjutkan Pendidikan</option>
                            <option value="tidak_bekerja"
                                <?php echo e(old('status', $tracer->status ?? '') == 'tidak_bekerja' ? 'selected' : ''); ?>>Tidak
                                Bekerja</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('tanggal_mulai', $tracer->tanggal_mulai->format('Y-m-d'))); ?>" required>
                    </div>

                    <div id="soal-form"></div>
                    <script>
                        const statusQuestions = {
                            'bekerja': [
                                'Berapa lama anda mendapatkan pekerjaan',
                                'Berapa rata-rata pendapatan per bulan anda (Take Home Pay)',
                                'Lokasi Tempat Anda Bekerja (Provinsi)',
                                'Lokasi Tempat Anda Bekerja (Kota / Kabupaten)',
                                'Jenis Perusahaan tempat anda bekerja',
                                'Nama Perusahaan tempat anda bekerja',
                                'Kategori perusahaan tempat anda bekerja',
                                'Informasi yang anda dapatkan untuk mencari pekerjaan'
                            ],
                            'wiraswasta': [
                                'Apakah jabatan/posisi anda ketika Berwirausaha',
                                'Nama Usaha anda',
                                'Pendapatan per bulan anda',
                                'Bidang Usaha',
                                'Berapa lama anda memulai usaha'
                            ],
                            'melanjutkan': [
                                'Jenjang melanjutkan',
                                'Nama Perguruan Tinggi',
                                'Nama Program Studi',
                                'Tanggal Bulan Tahun Masuk',
                                'Sumber Biaya'
                            ],
                            'tidak bekerja': [
                                'Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat surat atau e-mail) sebelum anda memeroleh pekerjaan pertama?',
                                'Berapa banyak perusahaan/instansi/institusi yang merespons lamaran anda?',
                                'Berapa banyak perusahaan/instansi/institusi yang mengundang anda untuk wawancara?'
                            ]
                        };

                        function renderSoal(status, values = {}) {
                            const container = document.getElementById('soal-form');
                            container.innerHTML = '';

                            if (!status || !statusQuestions[status]) return;

                            statusQuestions[status].forEach((question, index) => {
                                const questionNumber = index + 1;
                                const fieldName = `soal_${questionNumber}`;
                                const fieldValue = values[fieldName] || '';

                                const questionElement = document.createElement('div');
                                questionElement.className = 'mb-4';

                                questionElement.innerHTML = `
                                    <label class="block text-sm font-medium text-gray-700 mb-2">${question}</label>
                                    <input type="text"
                                           name="${fieldName}"
                                           class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="${fieldValue.replace(/"/g, '&quot;')}"
                                           required>
                                `;

                                container.appendChild(questionElement);
                            });
                        }

                        document.getElementById('status').addEventListener('change', function() {
                            renderSoal(this.value);
                        });

                        // Initialize form for edit or create
                        <?php
                            $currentStatus = old('status', $tracer->status ?? '');
                            $initialValues = [];
                            if (isset($tracer)) {
                                $soalCount = isset($statusQuestions[$currentStatus]) ? count($statusQuestions[$currentStatus]) : 0;
                                for ($i = 1; $i <= $soalCount; $i++) {
                                    $soalValue = old("soal_$i", $tracer->alumni->{$currentStatus}->{"soal_$i"} ?? '');
                                    $initialValues["soal_$i"] = $soalValue;
                                }
                            } else {
                                $soalCount = isset($statusQuestions[$currentStatus]) ? count($statusQuestions[$currentStatus]) : 0;
                                for ($i = 1; $i <= $soalCount; $i++) {
                                    $soalValue = old("soal_$i", '');
                                    $initialValues["soal_$i"] = $soalValue;
                                }
                            }
                        ?>

                        window.addEventListener('DOMContentLoaded', function() {
                            const status = <?php echo json_encode($currentStatus, 15, 512) ?>;
                            const initialValues = <?php echo json_encode($initialValues, 15, 512) ?>;
                            if (status && statusQuestions[status]) {
                                renderSoal(status, initialValues);
                            }
                        });
                    </script>

                    <div class="flex justify-end space-x-2">
                        <a href="<?php echo e(route('admin.tracer.index', $tracer)); ?>"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ml-2">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/tracer_edit.blade.php ENDPATH**/ ?>