<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin Pakar</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>">
</head>
<body>
<div class="login-page">
    <form class="login-card" method="POST" action="<?php echo e(route('admin.login.process')); ?>">
        <?php echo csrf_field(); ?>
        <div class="brand" style="margin-bottom:22px">
            <span class="brand-mark">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="12" rx="2" />
                    <path d="M2 20h20" />
                    <path d="M9 10l2 2 4-4" />
                </svg>
            </span>
            <span>Admin Sistem Pakar</span>
        </div>
        <h1 style="margin:0 0 8px">Login Pakar</h1>
        <p style="color:var(--muted);margin-top:0">Kelola gejala, kerusakan, rule, nilai CF, dan riwayat konsultasi.</p>
        <?php if(session('error')): ?> <div class="alert alert-error"><?php echo e(session('error')); ?></div> <?php endif; ?>
        <?php if($errors->any()): ?> <div class="alert alert-error"><?php echo e($errors->first()); ?></div> <?php endif; ?>
        <div class="form-group">
            <label class="label">Email</label>
            <input class="input" name="email" type="email" value="<?php echo e(old('email', 'admin@sistempakar.test')); ?>" required>
        </div>
        <div class="form-group">
            <label class="label">Password</label>
            <input class="input" name="password" type="password" value="password" required>
        </div>
        <button class="btn btn-primary btn-block">Masuk Dashboard</button>
        <p style="margin-bottom:0;color:var(--muted);font-size:13px">Default: admin@sistempakar.test / password</p>
    </form>
</div>
</body>
</html>
<?php /**PATH /home/dedsec/Sistem_Pakar_Kerusakan_Laptop/resources/views/admin/login.blade.php ENDPATH**/ ?>