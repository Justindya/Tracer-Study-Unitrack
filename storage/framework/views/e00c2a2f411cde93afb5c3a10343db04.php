<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'UniTrack')); ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        a { text-decoration: none; } 
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center mr-12">
                            <a href="<?php echo e(trim(strtolower(Auth::user()->role)) == 'admin' ? route('admin.dashboard') : route('dashboard')); ?>" class="flex items-center gap-2 group">
                                <i class="fas fa-graduation-cap text-3xl text-purple-600 group-hover:scale-110 transition"></i>
                                <span class="text-2xl font-bold text-gray-900 tracking-tight">UniTrack</span>
                            </a>
                        </div>

                        <div class="hidden sm:-my-px sm:flex items-center space-x-8">
                            
                            <?php if(trim(strtolower(Auth::user()->role)) == 'admin'): ?>
                                
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('admin.dashboard') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Dashboard</a>
                                <a href="<?php echo e(route('admin.alumni.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('admin.alumni.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Kelola Alumni</a>
                                <a href="<?php echo e(route('admin.event.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('admin.event.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Kelola Event</a>
                                <a href="<?php echo e(route('admin.loker.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('admin.loker.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Kelola Loker</a>
                                <a href="<?php echo e(route('admin.tracer.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('admin.tracer.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Data Tracer</a>
                            <?php else: ?>
                                
                                <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('dashboard') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Dashboard</a>
                                <a href="<?php echo e(route('user.lokers.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('user.lokers.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Lowongan</a>
                                <a href="<?php echo e(route('user.alumni.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('user.alumni.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Network</a>
                                <a href="<?php echo e(route('user.events.index')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('user.events.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Events</a>
                                <a href="<?php echo e(route('user.tracer.create')); ?>" class="text-gray-500 hover:text-blue-600 font-medium text-[15px] transition h-full flex items-center <?php echo e(request()->routeIs('user.tracer.*') ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : ''); ?>">Tracer</a>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                        
                        <?php if(trim(strtolower(Auth::user()->role)) != 'admin'): ?>
                        <div class="relative">
                            <button onclick="toggleNotif()" class="text-gray-400 hover:text-blue-600 relative focus:outline-none transition mt-1">
                                <i class="fas fa-bell text-2xl"></i>
                                <span class="absolute -top-1 -right-1 block h-4 w-4 rounded-full bg-red-500 text-white text-[9px] font-bold flex items-center justify-center ring-2 ring-white">2</span>
                            </button>
                            <div id="notif-dropdown" class="absolute right-0 mt-4 w-80 bg-white rounded-xl shadow-xl border border-gray-100 hidden z-50 overflow-hidden transform origin-top-right transition-all">
                                <div class="px-4 py-3 border-b border-gray-50 bg-gray-50 flex justify-between items-center">
                                    <h3 class="font-bold text-gray-800 text-sm">Notifikasi</h3>
                                </div>
                                <div class="p-4 text-center text-sm text-gray-500">Belum ada notifikasi baru.</div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="h-8 w-px bg-gray-200 mx-2"></div>

                        <div class="relative group">
                            <button class="flex items-center gap-3 focus:outline-none transition duration-150 ease-in-out">
                                <div class="text-right hidden md:block">
                                    <span class="block font-bold text-gray-800 text-sm leading-tight"><?php echo e(Auth::user()->name); ?></span>
                                    <span class="block text-xs text-gray-400">
                                        <?php echo e(trim(strtolower(Auth::user()->role)) == 'admin' ? 'Administrator' : 'Mahasiswa / Alumni'); ?>

                                    </span>
                                </div>
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border-2 border-white shadow-sm group-hover:shadow-md transition">
                                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                </div>
                            </button>
                            
                            <div class="absolute right-0 w-48 bg-white rounded-xl shadow-xl py-2 mt-2 hidden group-hover:block hover:block border border-gray-100 origin-top-right z-50">
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="fas fa-user-circle mr-2 w-5"></i> Profil Saya
                                </a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition rounded-b-xl">
                                        <i class="fas fa-sign-out-alt mr-2 w-5"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>

        <main>
            <?php if(isset($slot)): ?>
                <?php echo e($slot); ?>

            <?php else: ?>
                <div class="py-6">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
    
    <script>
        function toggleNotif() {
            const dropdown = document.getElementById('notif-dropdown');
            dropdown.classList.toggle('hidden');
        }
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('notif-dropdown');
            const button = document.querySelector('button[onclick="toggleNotif()"]');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/layouts/app.blade.php ENDPATH**/ ?>