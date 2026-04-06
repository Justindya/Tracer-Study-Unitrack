<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV ATS - <?php echo e($user->name); ?></title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.4; color: #000; font-size: 11pt; margin: 0 20px; }
        h1 { font-size: 24pt; text-transform: uppercase; margin-bottom: 5px; text-align: center; }
        .contact-info { text-align: center; font-size: 10pt; margin-bottom: 20px; }
        .contact-info span { margin: 0 5px; }
        h2 { font-size: 14pt; border-bottom: 1px solid #000; padding-bottom: 3px; margin-top: 20px; margin-bottom: 10px; text-transform: uppercase; }
        .item { margin-bottom: 15px; }
        .item-header { font-weight: bold; }
        .item-sub { font-style: italic; font-size: 10.5pt; color: #333; }
        .item-date { float: right; font-size: 10.5pt; }
        .skills { font-size: 10.5pt; }
    </style>
</head>
<body>

    <h1><?php echo e($user->name); ?></h1>
    <div class="contact-info">
        <span><?php echo e($user->email); ?></span> | 
        <span><?php echo e($alumni->no_hp ?? 'No HP Belum Diisi'); ?></span> | 
        <span><?php echo e($alumni->alamat ?? 'Alamat Belum Diisi'); ?></span>
        <?php if($alumni->linkedin): ?>
            <br><span>LinkedIn: <?php echo e($alumni->linkedin); ?></span>
        <?php endif; ?>
    </div>

    <?php if($alumni->bio): ?>
    <h2>Professional Summary</h2>
    <p><?php echo e($alumni->bio); ?></p>
    <?php endif; ?>

    <h2>Work Experience</h2>
    <?php
        $hasExperience = false;
    ?>

    <?php $__currentLoopData = $tracers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($tracer->status == 'bekerja' && $tracer->alumni->bekerja): ?>
            <?php $hasExperience = true; ?>
            <div class="item">
                <span class="item-header"><?php echo e($tracer->alumni->bekerja->soal_2); ?></span>
                <span class="item-date"><?php echo e(\Carbon\Carbon::parse($tracer->tanggal_mulai)->format('M Y')); ?> - Present</span>
                <div class="item-sub"><?php echo e($tracer->alumni->bekerja->soal_1); ?></div>
            </div>
        <?php elseif($tracer->status == 'wiraswasta' && $tracer->alumni->wiraswasta): ?>
            <?php $hasExperience = true; ?>
            <div class="item">
                <span class="item-header">Business Owner / Founder</span>
                <span class="item-date"><?php echo e(\Carbon\Carbon::parse($tracer->tanggal_mulai)->format('M Y')); ?> - Present</span>
                <div class="item-sub"><?php echo e($tracer->alumni->wiraswasta->soal_1); ?> (<?php echo e($tracer->alumni->wiraswasta->soal_2); ?>)</div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(!$hasExperience): ?>
        <p>Fresh Graduate</p>
    <?php endif; ?>

    <h2>Education</h2>
    
    <?php $__currentLoopData = $tracers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($tracer->status == 'melanjutkan_pendidikan' && $tracer->alumni->melanjutkanPendidikan): ?>
            <div class="item">
                <span class="item-header"><?php echo e($tracer->alumni->melanjutkanPendidikan->soal_1); ?></span>
                <span class="item-date"><?php echo e(\Carbon\Carbon::parse($tracer->tanggal_mulai)->format('Y')); ?> - Present</span>
                <div class="item-sub"><?php echo e($tracer->alumni->melanjutkanPendidikan->soal_3); ?> in <?php echo e($tracer->alumni->melanjutkanPendidikan->soal_2); ?></div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="item">
        <span class="item-header">Universitas Sugeng Hartono</span>
        <span class="item-date">Class of <?php echo e($alumni->angkatan); ?></span>
        <div class="item-sub">Bachelor's Degree in <?php echo e($alumni->program_studi); ?></div>
    </div>

    <?php if($alumni->skill): ?>
    <h2>Skills & Competencies</h2>
    <div class="skills">
        <?php echo e($alumni->skill); ?>

    </div>
    <?php endif; ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\Tracer-Study-UniTrack\resources\views/user/tracer/cv_pdf.blade.php ENDPATH**/ ?>