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
    <div class="py-8 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="w-full md:w-1/3">
                    <div class="bg-white p-5 rounded-2xl shadow-sm text-center sticky top-24 border border-gray-100">
                        <div class="w-24 h-24 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 text-white text-3xl font-bold border-4 border-blue-100 shadow-sm overflow-hidden">
                            <?php if(Auth::user()->alumni && Auth::user()->alumni->Foto): ?>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->alumni->Foto)); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            <?php endif; ?>
                        </div>
                        
                        <h2 class="text-lg font-bold text-gray-900 break-words"><?php echo e($user->name); ?></h2>
                        <p class="text-gray-500 text-xs mb-5"><?php echo e($user->email); ?></p>

                        <nav class="mt-4 text-left space-y-1">
                            <a href="#info" class="flex items-center px-3 py-2 text-blue-600 font-bold text-xs bg-blue-50 rounded-lg transition">
                                <i class="fas fa-user-cog w-5 text-center"></i> Akun Login
                            </a>
                            <a href="<?php echo e(route('user.alumni.edit', Auth::user()->alumni->id ?? 0)); ?>" class="flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-xs transition">
                                <i class="fas fa-id-card w-5 text-center"></i> Biodata & Bio
                            </a>
                            <a href="#password" class="flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg text-xs transition">
                                <i class="fas fa-lock w-5 text-center"></i> Ganti Password
                            </a>
                            <a href="#delete" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 rounded-lg text-xs transition mt-2 pt-2 border-t">
                                <i class="fas fa-trash-alt w-5 text-center"></i> Hapus Akun
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="w-full md:w-2/3 space-y-5">
                    
                    <div id="info" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 scroll-mt-24">
                        <div class="flex justify-between items-center mb-4 pb-3 border-b">
                            <h3 class="text-base font-bold text-gray-900">Pengaturan Akun</h3>
                        </div>
                        
                        <form method="post" action="<?php echo e(route('profile.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="grid grid-cols-1 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Akun</label>
                                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Email Login</label>
                                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-sm" required>
                                </div>
                            </div>

                            <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-4 flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-indigo-900 text-xs">Lengkapi Profil Publik?</h4>
                                    <p class="text-[10px] text-indigo-600 mt-0.5">Bio, Foto, LinkedIn, dll.</p>
                                </div>
                                <?php if(Auth::user()->alumni): ?>
                                    <a href="<?php echo e(route('user.alumni.edit', Auth::user()->alumni->id)); ?>" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-[10px] font-bold rounded-md hover:bg-indigo-700 transition">
                                        Edit Biodata <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="flex items-center gap-3">
                                <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-black transition shadow-sm">
                                    Simpan Perubahan
                                </button>
                                <?php if(session('status') === 'profile-updated'): ?>
                                    <span class="text-xs text-green-600 font-medium animate-pulse"><i class="fas fa-check-circle mr-1"></i> Tersimpan.</span>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <div id="password" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 scroll-mt-24">
                        <h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b">Ganti Password</h3>
                        
                        <form method="post" action="<?php echo e(route('password.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>

                            <div class="space-y-3 mb-4 max-w-sm">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Password Saat Ini</label>
                                    <input type="password" name="current_password" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none text-sm">
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->updatePassword->get('current_password'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->updatePassword->get('current_password')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Password Baru</label>
                                    <input type="password" name="password" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none text-sm">
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->updatePassword->get('password'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->updatePassword->get('password')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none text-sm">
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->updatePassword->get('password_confirmation'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->updatePassword->get('password_confirmation')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-black transition shadow-sm">
                                Update Password
                            </button>
                        </form>
                    </div>

                    <div id="delete" class="bg-red-50 p-6 rounded-2xl shadow-sm border border-red-100 scroll-mt-24">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-bold text-red-700">Hapus Akun Permanen</h3>
                                <p class="text-red-600/70 text-[10px] mt-0.5">Data tidak bisa dikembalikan.</p>
                            </div>
                            <form method="post" action="<?php echo e(route('profile.destroy')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <button onclick="return confirm('Yakin?')" type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-red-700 transition">
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/profile/edit.blade.php ENDPATH**/ ?>