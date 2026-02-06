<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">Selamat datang kembali, Administrator.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                        <i class="fas fa-user-graduate text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase">Total</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1"><?php echo e($totalAlumni); ?></h3>
                <p class="text-sm text-gray-500 mb-4">Alumni Terdaftar</p>
                <a href="<?php echo e(route('admin.alumni.index')); ?>" class="text-xs font-bold text-blue-600 hover:underline">Lihat Detail -></a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase">Aktif</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1"><?php echo e(\App\Models\Event::count()); ?></h3>
                <p class="text-sm text-gray-500 mb-4">Event Kampus</p>
                <a href="<?php echo e(route('admin.event.index')); ?>" class="text-xs font-bold text-emerald-600 hover:underline">Lihat Detail -></a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase">Open</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1"><?php echo e(\App\Models\Loker::count()); ?></h3>
                <p class="text-sm text-gray-500 mb-4">Lowongan Kerja</p>
                <a href="<?php echo e(route('admin.loker.index')); ?>" class="text-xs font-bold text-amber-600 hover:underline">Lihat Detail -></a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase">Input</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1"><?php echo e($totalTracer); ?></h3>
                <p class="text-sm text-gray-500 mb-4">Data Tracer</p>
                <a href="<?php echo e(route('admin.tracer.index')); ?>" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Detail -></a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 text-lg">Grafik Tracer Study (Gender)</h3>
                    <div class="flex gap-2 mt-4 md:mt-0">
                        <a href="<?php echo e(route('admin.alumni.export.all')); ?>" class="bg-green-600 hover:bg-green-700 text-white text-xs px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                            <i class="fas fa-file-excel"></i> Export Alumni
                        </a>
                        <a href="<?php echo e(route('admin.tracer.export.all')); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                            <i class="fas fa-file-excel"></i> Export Tracer
                        </a>
                    </div>
                </div>
                
                <div class="relative h-80 w-full">
                    <canvas id="tracerGenderChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
                <h3 class="font-bold text-gray-800 text-lg mb-6 border-b border-gray-100 pb-4">Statistik Tracer</h3>
                
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <h6 class="text-blue-600 font-bold text-sm mb-1">Laki-laki</h6>
                        <p class="text-2xl font-bold text-gray-800"><?php echo e($tracerMale); ?></p>
                        <small class="text-xs text-gray-500">dari <?php echo e($totalMale); ?> alumni</small>
                    </div>
                    <div class="text-center p-4 bg-pink-50 rounded-xl">
                        <h6 class="text-pink-600 font-bold text-sm mb-1">Perempuan</h6>
                        <p class="text-2xl font-bold text-gray-800"><?php echo e($tracerFemale); ?></p>
                        <small class="text-xs text-gray-500">dari <?php echo e($totalFemale); ?> alumni</small>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl text-center border border-gray-100">
                    <h6 class="text-gray-500 font-bold text-sm mb-2">Total Populasi Alumni</h6>
                    <p class="text-4xl font-extrabold text-gray-900"><?php echo e($totalAlumni); ?></p>
                    <div class="mt-2 text-xs font-medium text-gray-500">
                        Partisipasi Tracer: <span class="text-indigo-600"><?php echo e($totalTracer); ?> Alumni</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('tracerGenderChart').getContext('2d');
    const tracerGenderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Sudah Mengisi Tracer',
                data: [<?php echo e($tracerMale); ?>, <?php echo e($tracerFemale); ?>],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)', 
                    'rgba(236, 72, 153, 0.8)'  
                ],
                borderRadius: 6,
                borderWidth: 0
            }, {
                label: 'Total Populasi',
                data: [<?php echo e($totalMale); ?>, <?php echo e($totalFemale); ?>],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.2)',
                    'rgba(236, 72, 153, 0.2)'
                ],
                borderRadius: 6,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { family: "'Inter', sans-serif" }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' }, 
                    ticks: { font: { family: "'Inter', sans-serif" } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: "'Inter', sans-serif" } }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>