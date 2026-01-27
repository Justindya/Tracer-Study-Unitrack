<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Akun - UniTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Poppins', sans-serif; } 
        .transition-all { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center min-h-screen p-4 py-8">

    <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl p-8 relative border border-white/50 backdrop-blur-sm">
        
        <a href="/" class="absolute top-6 left-6 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-arrow-left text-xl"></i></a>

        <div class="text-center mb-8 mt-2">
            <div class="flex justify-center items-center gap-2 mb-1">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">UniTrack</span>
            </div>
            <p class="text-gray-500 text-sm">Lengkapi data diri untuk bergabung.</p>
        </div>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <?php echo csrf_field(); ?>

            <div class="col-span-1 md:col-span-2 mb-2">
                <label class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wide text-center">Status Anda Saat Ini</label>
                <div class="flex p-1 bg-gray-100 rounded-xl relative max-w-sm mx-auto">
                    <label class="flex-1 text-center cursor-pointer z-10">
                        <input type="radio" name="status_user" value="alumni" class="hidden peer" checked onclick="toggleTahunLulus(true)">
                        <span class="block py-2.5 rounded-lg text-xs font-bold text-gray-500 peer-checked:bg-white peer-checked:text-blue-600 peer-checked:shadow-sm transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-graduation-cap"></i> Alumni
                        </span>
                    </label>
                    <label class="flex-1 text-center cursor-pointer z-10">
                        <input type="radio" name="status_user" value="mahasiswa" class="hidden peer" onclick="toggleTahunLulus(false)">
                        <span class="block py-2.5 rounded-lg text-xs font-bold text-gray-500 peer-checked:bg-white peer-checked:text-blue-600 peer-checked:shadow-sm transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-book-reader"></i> Mahasiswa
                        </span>
                    </label>
                </div>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Nama Lengkap</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="Nama Anda">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="email@contoh.com">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-600 mb-1 block">NIM</label>
                <input type="text" name="nim" value="<?php echo e(old('nim')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="NIM">
                <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-600 mb-1 block">No HP / WhatsApp</label>
                <input type="number" name="no_hp" value="<?php echo e(old('no_hp')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="08xxxxxxxxxx">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-600 mb-1 block">Tahun Angkatan</label>
                <input type="number" name="angkatan" value="<?php echo e(old('angkatan')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="2020">
            </div>

            <div id="field-tahun-lulus" class="transition-all duration-300">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Tahun Lulus</label>
                <input type="number" id="input-tahun-lulus" name="tahun_lulus" value="<?php echo e(old('tahun_lulus')); ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="2024">
            </div>

            <div class="col-span-2">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Program Studi</label>
                <div class="relative">
                    <select name="program_studi" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white appearance-none cursor-pointer text-sm" required>
                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                        <option value="Sistem Informasi">Ilmu Komputer</option>
                        <option value="Bisnis Digital">Bisnis Digital</option>
                        <option value="Gizi">Gizi</option>
                        <option value="Hukum Bisnis">Hukum Bisnis</option>
                        <option value="Teknologi Pangan">Teknologi Pangan</option>
                        <option value="Manajemen Bisnis Internasional">Manajemen Bisnis Internasional</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="col-span-2">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Alamat Lengkap</label>
                <textarea name="alamat" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required placeholder="Alamat lengkap..."><?php echo e(old('alamat')); ?></textarea>
            </div>

            <div class="col-span-2">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Jenis Kelamin</label>
                <div class="flex gap-4">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="laki-laki" class="hidden peer" required>
                        <div class="px-4 py-3 rounded-xl border border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 text-center text-xs font-bold text-gray-500 peer-checked:text-blue-600 transition hover:bg-gray-50">
                            <i class="fas fa-male mr-1 text-sm"></i> Laki-laki
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="perempuan" class="hidden peer">
                        <div class="px-4 py-3 rounded-xl border border-gray-200 peer-checked:border-pink-500 peer-checked:bg-pink-50 text-center text-xs font-bold text-gray-500 peer-checked:text-pink-600 transition hover:bg-gray-50">
                            <i class="fas fa-female mr-1 text-sm"></i> Perempuan
                        </div>
                    </label>
                </div>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required autocomplete="new-password" placeholder="********">
                <p class="text-[10px] text-gray-400 mt-1 ml-1">Minimal 8 karakter.</p>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="text-xs font-bold text-gray-600 mb-1 block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition bg-gray-50 focus:bg-white text-sm" required autocomplete="new-password" placeholder="********">
            </div>

            <div class="col-span-2 mt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg shadow-blue-200 transform hover:-translate-y-0.5 text-sm">
                    BUAT AKUN
                </button>
            </div>
        </form>

        <div class="text-center mt-8 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-500">Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="text-blue-600 font-bold hover:underline transition">Masuk Disini</a></p>
        </div>
    </div>

    <script>
        function toggleTahunLulus(isAlumni) {
            const field = document.getElementById('field-tahun-lulus');
            const input = document.getElementById('input-tahun-lulus');
            
            if (isAlumni) {
                field.style.display = 'block';
                field.style.opacity = '0';
                setTimeout(() => field.style.opacity = '1', 50);
                input.required = true;
                input.value = ''; 
            } else {
                field.style.opacity = '0';
                setTimeout(() => field.style.display = 'none', 300);
                input.required = false;
                input.value = ''; 
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const statusRadio = document.querySelector('input[name="status_user"]:checked');
            if(statusRadio) {
                toggleTahunLulus(statusRadio.value === 'alumni');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/auth/register.blade.php ENDPATH**/ ?>