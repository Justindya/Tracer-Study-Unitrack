<!DOCTYPE html>
<html lang="id">
<head>
    <title>Masuk - UniTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8 relative border border-white/50 backdrop-blur-sm">
        
        <a href="/" class="absolute top-6 left-6 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-arrow-left text-xl"></i></a>

        <div class="text-center mb-8 mt-4">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">UniTrack</span>
            </div>
            <p class="text-gray-500 text-sm">Masuk untuk melanjutkan aktivitas Anda.</p>
        </div>

        <?php if(session('status')): ?>
            <div class="mb-5 text-xs font-medium text-green-700 bg-green-50 p-3 rounded-xl border border-green-100 text-center">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            
            <div>
                <label class="text-xs font-bold text-gray-600 mb-1 block uppercase tracking-wide">NIM</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="far fa-id-card"></i>
                    </span>
                    <input type="text" name="nim" value="<?php echo e(old('nim')); ?>" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white font-medium text-sm" placeholder="Contoh: 12345678" required autofocus>
                </div>
                <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1 ml-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-600 mb-1 block uppercase tracking-wide">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white font-medium text-sm" placeholder="••••••••" required>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1 ml-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                    <span class="ml-2 text-xs text-gray-500 font-medium group-hover:text-blue-600 transition">Ingat Saya</span>
                </label>
                <?php if(Route::has('password.request')): ?>
                    <a class="text-xs text-blue-600 hover:text-blue-800 font-bold hover:underline transition" href="<?php echo e(route('password.request')); ?>">
                        Lupa Password?
                    </a>
                <?php endif; ?>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg shadow-blue-200 transform hover:-translate-y-0.5 flex justify-center items-center gap-2 text-sm">
                MASUK SEKARANG <i class="fas fa-arrow-right text-xs"></i>
            </button>
        </form>

        <div class="text-center mt-8 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-500">Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-blue-600 font-bold hover:underline transition">Daftar di sini</a></p>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/auth/login.blade.php ENDPATH**/ ?>