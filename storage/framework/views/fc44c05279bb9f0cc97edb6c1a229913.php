<?php $__env->startSection('title', 'Detail Konsultasi'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top"><div class="admin-title"><h1>Detail Konsultasi</h1><p><?php echo e($konsultasi->nama_pengguna); ?> · <?php echo e($konsultasi->tanggal->format('d/m/Y H:i')); ?></p></div><a class="btn btn-light" href="<?php echo e(route('admin.konsultasi.index')); ?>">Kembali</a></div>
<div class="result-hero">
    <div class="card"><div class="score-circle" style="--score: <?php echo e(min($konsultasi->nilai_cf, 100)); ?>%"><strong><?php echo e($konsultasi->nilai_cf); ?>%</strong></div></div>
    <div class="card"><span class="badge badge-blue"><?php echo e($konsultasi->hasilUtama->kategori); ?></span><h2><?php echo e($konsultasi->hasilUtama->nama_kerusakan); ?></h2><p><?php echo e($konsultasi->hasilUtama->deskripsi); ?></p><h3>Solusi</h3><p><?php echo e($konsultasi->hasilUtama->solusi); ?></p></div>
</div>
<div class="section" style="padding-bottom:0"><h2>Hasil Alternatif</h2><div class="table-wrap"><table class="table"><thead><tr><th>Kerusakan</th><th>CF</th><th>Gejala Cocok</th></tr></thead><tbody>
<?php $__currentLoopData = $konsultasi->hasilDiagnosa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hasil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><?php echo e($hasil->kerusakan->nama_kerusakan); ?></td><td><?php echo e($hasil->nilai_cf); ?>%</td><td><?php $__currentLoopData = $hasil->gejala_cocok_json ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><span class="code"><?php echo e($g['kode']); ?></span> <?php echo e($g['nama']); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/konsultasi/show.blade.php ENDPATH**/ ?>