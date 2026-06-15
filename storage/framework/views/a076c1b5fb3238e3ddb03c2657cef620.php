<?php $__env->startSection('title', 'Riwayat Konsultasi'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top"><div class="admin-title"><h1>Riwayat Konsultasi</h1><p>Data hasil konsultasi pengguna.</p></div></div>
<form class="form-card" method="GET" style="margin-bottom:16px;padding:16px">
    <div class="grid-4" style="align-items:end">
        <div class="form-group" style="margin:0"><label class="label">Cari Nama</label><input class="input" name="q" value="<?php echo e(request('q')); ?>" placeholder="Nama pengguna"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Mulai</label><input class="input" type="date" name="tanggal_mulai" value="<?php echo e(request('tanggal_mulai')); ?>"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Selesai</label><input class="input" type="date" name="tanggal_selesai" value="<?php echo e(request('tanggal_selesai')); ?>"></div>
        <button class="btn btn-primary">Filter</button>
    </div>
</form>
<div class="table-wrap"><table class="table"><thead><tr><th>Nama</th><th>Hasil Utama</th><th>CF</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $konsultasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($item->nama_pengguna); ?></td><td><strong><?php echo e($item->hasilUtama?->nama_kerusakan); ?></strong></td><td><?php echo e($item->nilai_cf); ?>%</td><td><?php echo e($item->tanggal->format('d/m/Y H:i')); ?></td><td class="action-row"><a class="btn btn-light" href="<?php echo e(route('admin.konsultasi.show', $item)); ?>">Detail</a><form method="POST" action="<?php echo e(route('admin.konsultasi.destroy', $item)); ?>" data-confirm="Hapus riwayat ini?"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger">Hapus</button></form></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="5" class="empty-state">Belum ada konsultasi.</td></tr>
<?php endif; ?>
</tbody></table></div>
<?php echo e($konsultasis->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/konsultasi/index.blade.php ENDPATH**/ ?>