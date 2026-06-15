<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin Sistem Pakar'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
    <script src="<?php echo e(asset('assets/js/app.js')); ?>" defer></script>
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar no-print">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand">
            <span class="brand-mark">SP</span>
            <span>Admin Pakar</span>
        </a>
        <div class="side-menu">
            <a class="side-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
            <a class="side-link <?php echo e(request()->routeIs('admin.gejala.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.gejala.index')); ?>">Data Gejala</a>
            <a class="side-link <?php echo e(request()->routeIs('admin.kerusakan.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.kerusakan.index')); ?>">Data Kerusakan</a>
            <a class="side-link <?php echo e(request()->routeIs('admin.rule.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.rule.index')); ?>">Rule & CF</a>
            <a class="side-link <?php echo e(request()->routeIs('admin.konsultasi.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.konsultasi.index')); ?>">Riwayat</a>
            <a class="side-link <?php echo e(request()->routeIs('admin.laporan.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.laporan.index')); ?>">Laporan</a>
            <a class="side-link" href="<?php echo e(route('home')); ?>">Lihat Website</a>
            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="side-link" style="width:100%;border:0;background:transparent;cursor:pointer;text-align:left">Logout</button>
            </form>
        </div>
    </aside>
    <main class="admin-main">
        <?php if(session('success')): ?> <div class="alert alert-success"><?php echo e(session('success')); ?></div> <?php endif; ?>
        <?php if(session('error')): ?> <div class="alert alert-error"><?php echo e(session('error')); ?></div> <?php endif; ?>
        <?php if($errors->any()): ?> <div class="alert alert-error"><?php echo e($errors->first()); ?></div> <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>
</body>
</html>
<?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>