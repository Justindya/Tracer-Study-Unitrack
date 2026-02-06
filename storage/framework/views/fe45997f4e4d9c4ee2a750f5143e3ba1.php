<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Data Tracer</h1>
        <form action="<?php echo e(route('user.tracer.update', $tracer->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('user.tracer.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('user.tracer.index')); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/edit.blade.php ENDPATH**/ ?>