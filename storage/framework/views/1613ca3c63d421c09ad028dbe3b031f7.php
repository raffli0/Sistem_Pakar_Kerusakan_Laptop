<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top">
    <div class="admin-title"><h1>Dashboard Sistem Pakar</h1><p>Ringkasan basis pengetahuan, rule, dan riwayat konsultasi.</p></div>
    <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>">Tes Konsultasi</a>
</div>
<div class="grid-4">
    <div class="stat-card"><span>Total Gejala</span><strong><?php echo e($jumlahGejala); ?></strong></div>
    <div class="stat-card"><span>Total Kerusakan</span><strong><?php echo e($jumlahKerusakan); ?></strong></div>
    <div class="stat-card"><span>Total Rule</span><strong><?php echo e($jumlahRule); ?></strong></div>
    <div class="stat-card"><span>Konsultasi</span><strong><?php echo e($jumlahKonsultasi); ?></strong></div>
</div>
<div class="section">
    <div class="grid-3" style="grid-template-columns:1.2fr .8fr;align-items:start">
        <div class="card">
            <h3>Konsultasi Terbaru</h3>
            <div class="table-wrap" style="margin-top:14px">
                <table class="table">
                    <thead><tr><th>Nama</th><th>Hasil</th><th>CF</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $konsultasiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr><td><?php echo e($item->nama_pengguna); ?></td><td><?php echo e($item->hasilUtama?->nama_kerusakan); ?></td><td><?php echo e($item->nilai_cf); ?>%</td><td><?php echo e($item->tanggal->format('d/m/Y')); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="empty-state">Belum ada konsultasi.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <h3>Diagnosa Terbanyak</h3>
            <?php $__empty_1 = true; $__currentLoopData = $topDiagnosa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="metric" style="margin-top:12px"><span><?php echo e($item->kerusakan?->nama_kerusakan); ?></span><strong><?php echo e($item->total); ?></strong></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">Belum ada data.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>