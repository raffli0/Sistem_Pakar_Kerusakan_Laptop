<?php $__env->startSection('title', 'Laporan Konsultasi'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top"><div class="admin-title"><h1>Laporan Konsultasi</h1><p>Filter dan cetak rekap hasil konsultasi.</p></div><button class="btn btn-primary no-print" onclick="window.print()">Cetak Laporan</button></div>
<form class="form-card no-print" method="GET" style="margin-bottom:16px;padding:16px">
    <div class="grid-3" style="align-items:end">
        <div class="form-group" style="margin:0"><label class="label">Tanggal Mulai</label><input class="input" type="date" name="tanggal_mulai" value="<?php echo e(request('tanggal_mulai')); ?>"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Selesai</label><input class="input" type="date" name="tanggal_selesai" value="<?php echo e(request('tanggal_selesai')); ?>"></div>
        <button class="btn btn-primary">Terapkan Filter</button>
    </div>
</form>
<div class="grid-3" style="grid-template-columns:1.2fr .8fr;align-items:start">
    <div class="card"><h3>Data Konsultasi</h3><div class="table-wrap" style="margin-top:14px"><table class="table"><thead><tr><th>Nama</th><th>Diagnosa</th><th>CF</th><th>Tanggal</th></tr></thead><tbody>
    <?php $__empty_1 = true; $__currentLoopData = $konsultasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr><td><?php echo e($item->nama_pengguna); ?></td><td><?php echo e($item->hasilUtama?->nama_kerusakan); ?></td><td><?php echo e($item->nilai_cf); ?>%</td><td><?php echo e($item->tanggal->format('d/m/Y H:i')); ?></td></tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4" class="empty-state">Tidak ada data.</td></tr>
    <?php endif; ?>
    </tbody></table></div></div>
    <div class="card"><h3>Statistik Diagnosa</h3>
    <?php $__empty_1 = true; $__currentLoopData = $topDiagnosa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="metric" style="margin-top:12px"><span><?php echo e($item->kerusakan?->nama_kerusakan); ?><br><small>Rata-rata CF <?php echo e(number_format($item->rata_cf, 2)); ?>%</small></span><strong><?php echo e($item->total); ?></strong></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">Tidak ada statistik.</div>
    <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>