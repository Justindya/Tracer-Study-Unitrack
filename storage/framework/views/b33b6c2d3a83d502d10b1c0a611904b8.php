<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .activity-scroll::-webkit-scrollbar { width: 4px; }
        .activity-scroll::-webkit-scrollbar-track { background: transparent; }
        .activity-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .activity-scroll::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>

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
                            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition <?php echo e(request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                <i class="fas fa-home w-5 text-center"></i> Overview
                            </a>
                            <a href="<?php echo e($tracerComplete ? route('user.tracer.index') : route('user.tracer.create')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-gray-600 hover:bg-gray-50">
                                <i class="fas <?php echo e($tracerComplete ? 'fa-check-circle text-green-500' : 'fa-clipboard-list'); ?> w-5 text-center"></i> 
                                <?php echo e($tracerComplete ? 'Data Tracer' : 'Isi Tracer Study'); ?>

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
                    
                    
                    <div class="pb-1 border-b border-gray-200/60 mb-4">
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Halo, <?php echo e(explode(' ', Auth::user()->name)[0]); ?>! 👋</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Pantau progres karir dan status lamaranmu.</p>
                    </div>

                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Terkirim</p>
                                <div class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-paper-plane text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo e($lamaranCount); ?></h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Diterima</p>
                                <div class="w-7 h-7 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                                    <i class="fas fa-check-circle text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo e($diterimaCount); ?></h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Diproses</p>
                                <div class="w-7 h-7 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600">
                                    <i class="fas fa-clock text-[10px]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo e($diprosesCount); ?></h3>
                        </div>

                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between h-28 hover:shadow transition duration-200">
                            <div class="flex items-start justify-between w-full">
                                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Bookmark</p>
                                <div class="w-7 h-7 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-600">
                                    <i class="fas fa-bookmark text-[10px]"></i>
                                </div>
                            </div>
                            <h3 id="count-bookmark" class="text-2xl font-bold text-gray-800">0</h3>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        
                        
                        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col h-full">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-gray-800 text-base tracking-tight">Kelengkapan Profil</h3>
                                <span class="text-[11px] font-bold <?php echo e($progress == 100 ? 'text-green-700 bg-green-50' : 'text-blue-700 bg-blue-50'); ?> px-2.5 py-1 rounded-md"><?php echo e($progress); ?>%</span>
                            </div>

                            <div class="flex-1 px-1">
                                <ul class="relative border-l border-gray-200 space-y-6 pb-2 ml-2">
                                    
                                    
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 bg-green-500 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white">
                                            <i class="fas fa-check text-white text-[8px]"></i>
                                        </span>
                                        <h4 class="font-semibold text-gray-800 text-sm">Akun Terdaftar</h4>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Registrasi berhasil dilakukan.</p>
                                    </li>

                                    
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white <?php echo e($bioComplete ? 'bg-green-500' : 'bg-gray-200'); ?>">
                                            <?php if($bioComplete): ?>
                                                <i class="fas fa-check text-white text-[8px]"></i>
                                            <?php endif; ?>
                                        </span>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold <?php echo e($bioComplete ? 'text-gray-800' : 'text-gray-500'); ?> text-sm">Biodata Lengkap</h4>
                                                <p class="text-[11px] text-gray-400 mt-0.5"><?php echo e($bioComplete ? 'Data diri sudah diperbarui.' : 'Data diri dan kontak belum lengkap.'); ?></p>
                                            </div>
                                            <?php if(!$bioComplete && Auth::user()->alumni): ?>
                                                <a href="<?php echo e(route('user.alumni.edit', Auth::user()->alumni->id)); ?>" class="text-blue-600 hover:underline text-[11px] font-semibold">Lengkapi</a>
                                            <?php endif; ?>
                                        </div>
                                    </li>

                                    
                                    <li class="relative pl-5">
                                        <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full flex items-center justify-center ring-4 ring-white <?php echo e($tracerComplete ? 'bg-green-500' : 'bg-gray-200'); ?>">
                                            <?php if($tracerComplete): ?>
                                                <i class="fas fa-check text-white text-[8px]"></i>
                                            <?php endif; ?>
                                        </span>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold <?php echo e($tracerComplete ? 'text-gray-800' : 'text-gray-500'); ?> text-sm">Tracer Study</h4>
                                                <p class="text-[11px] text-gray-400 mt-0.5"><?php echo e($tracerComplete ? 'Status karir telah terekam.' : 'Kuesioner karir belum diisi.'); ?></p>
                                            </div>
                                            <?php if(!$tracerComplete): ?>
                                                <a href="<?php echo e(route('user.tracer.create')); ?>" class="text-blue-600 hover:underline text-[11px] font-semibold">Isi Sekarang</a>
                                            <?php endif; ?>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        
                        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm h-full flex flex-col">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-gray-800 text-base tracking-tight">Aktivitas Terkini</h3>
                                <a href="<?php echo e(route('user.lamaran.index')); ?>" class="text-[11px] font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                            </div>

                            <div class="flex-1 overflow-y-auto activity-scroll space-y-0 max-h-[220px] pr-2">
                                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="relative pl-5 pb-5">
                                        <div class="absolute left-0 top-1.5 w-1.5 h-1.5 bg-blue-400 rounded-full ring-2 ring-white z-10"></div>
                                        <?php if(!$loop->last): ?>
                                            <div class="absolute left-[2px] top-3 bottom-[-10px] w-[1px] bg-gray-100"></div>
                                        <?php endif; ?>
                                        
                                        <div>
                                            <div class="flex justify-between items-baseline mb-0.5">
                                                <p class="text-sm font-semibold text-gray-800 leading-none">Lamaran <span class="capitalize"><?php echo e($act->status); ?></span></p>
                                                <span class="text-[10px] text-gray-400"><?php echo e($act->created_at->diffForHumans()); ?></span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 truncate max-w-[200px] sm:max-w-[250px]"><?php echo e($act->loker->judul ?? 'Lowongan telah dihapus'); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="h-full flex flex-col items-center justify-center text-center py-8">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-ghost text-gray-300 text-xl"></i>
                                        </div>
                                        <p class="text-xs font-semibold text-gray-600">Belum ada aktivitas</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
            const bookmarkElement = document.getElementById('count-bookmark');
            if (bookmarkElement) {
                bookmarkElement.innerText = bookmarks.length;
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/dashboard.blade.php ENDPATH**/ ?>