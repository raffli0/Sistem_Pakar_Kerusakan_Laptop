<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Sistem Pakar Laptop'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
    <script src="<?php echo e(asset('assets/js/app.js')); ?>" defer></script>
</head>
<body>
<div class="page">
    <nav class="navbar no-print">
        <div class="container nav-inner">
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <span class="brand-mark">SP</span>
                <span>Sistem Pakar Laptop</span>
            </a>
            <div class="nav-menu">
                <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Beranda</a>
                <a class="nav-link <?php echo e(request()->routeIs('consultation.*') ? 'active' : ''); ?>" href="<?php echo e(route('consultation.create')); ?>">Konsultasi</a>
                <a class="nav-link" href="<?php echo e(route('admin.login')); ?>">Admin/Pakar</a>
            </div>
        </div>
    </nav>

    <?php if(session('success')): ?>
        <div class="container" style="padding-top:18px"><div class="alert alert-success"><?php echo e(session('success')); ?></div></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="container" style="padding-top:18px"><div class="alert alert-error"><?php echo e(session('error')); ?></div></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="container" style="padding-top:18px"><div class="alert alert-error"><?php echo e($errors->first()); ?></div></div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>
<?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>