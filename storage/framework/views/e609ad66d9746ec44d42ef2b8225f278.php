<?php $__env->startSection('content'); ?>
<div class="py-10 bg-gray-50 min-h-screen font-sans">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Biodata</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil publik Anda.</p>
            </div>
            <a href="<?php echo e(route('profile.edit')); ?>" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm hover:shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="<?php echo e(route('user.alumni.update', $alumni->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Data Personal</h2>
                </div>
                
                <div class="p-6 space-y-5">
                    <div class="flex items-center gap-5">
                        <div class="relative group">
                            <?php if($alumni->Foto): ?>
                                <img src="<?php echo e(asset('storage/' . $alumni->Foto)); ?>" class="w-20 h-20 rounded-full object-cover border-4 border-gray-100 shadow-sm group-hover:border-blue-100 transition">
                            <?php else: ?>
                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-2xl border-4 border-white shadow-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php endif; ?>
                            <div class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-1.5 border-2 border-white shadow-sm pointer-events-none">
                                <i class="fas fa-camera text-[10px]"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto Profil</label>
                            <input type="file" name="Foto" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer transition">
                            <p class="text-[10px] text-gray-400 mt-1 ml-1">Format: JPG, PNG. Maks 2MB.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?php echo e($alumni->nama); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIM</label>
                            <input type="text" name="nim" value="<?php echo e($alumni->nim); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm cursor-not-allowed" readonly>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email Kontak</label>
                            <input type="email" name="email" value="<?php echo e($alumni->email); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">No HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="<?php echo e($alumni->no_hp); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm bg-white">
                            <option value="laki-laki" <?php echo e($alumni->jenis_kelamin == 'laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                            <option value="perempuan" <?php echo e($alumni->jenis_kelamin == 'perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Domisili</label>
                        <textarea name="alamat" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" required><?php echo e($alumni->alamat); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                        <i class="fas fa-graduation-cap text-sm"></i>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Akademik & Karir</h2>
                </div>

                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Angkatan</label>
                            <input type="text" name="angkatan" value="<?php echo e($alumni->angkatan); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" value="<?php echo e($alumni->tahun_lulus); ?>" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" placeholder="Isi '-' jika masih kuliah" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Program Studi</label>
                        <div class="relative">
                            <select name="program_studi" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm bg-white appearance-none">
                                <option value="Sistem Informasi" <?php echo e($alumni->program_studi == 'Sistem Informasi' ? 'selected' : ''); ?>>Sistem Informasi</option>
                                <option value="Bisnis Digital" <?php echo e($alumni->program_studi == 'Bisnis Digital' ? 'selected' : ''); ?>>Bisnis Digital</option>
                                <option value="Gizi" <?php echo e($alumni->program_studi == 'Gizi' ? 'selected' : ''); ?>>Gizi</option>
                                <option value="<?php echo e($alumni->program_studi); ?>" selected><?php echo e($alumni->program_studi); ?></option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Link LinkedIn</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fab fa-linkedin text-blue-700"></i>
                            </div>
                            <input type="url" name="linkedin" value="<?php echo e($alumni->linkedin); ?>" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Keahlian / Skill</label>
                        <textarea name="skill" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" placeholder="Contoh: Laravel, Desain Grafis, Public Speaking"><?php echo e($alumni->skill); ?></textarea>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Pisahkan setiap skill dengan tanda koma (,).</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Bio / Tentang Saya</label>
                        <textarea name="bio" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm transition" placeholder="Ceritakan pengalaman, minat karir, atau deskripsi diri Anda..."><?php echo e($alumni->bio); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mb-12">
                <a href="<?php echo e(route('user.alumni.index')); ?>" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-8 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md transition transform hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/alumni_edit.blade.php ENDPATH**/ ?>