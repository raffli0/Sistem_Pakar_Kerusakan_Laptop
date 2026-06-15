<?php $__env->startSection('title', 'Data Kerusakan'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top">
    <div class="admin-title"><h1>Data Kerusakan</h1><p>Kelola jenis kerusakan, penyebab, dan solusi awal.</p></div>
    <a class="btn btn-primary" href="<?php echo e(route('admin.kerusakan.create')); ?>">Tambah Kerusakan</a>
</div>
<form class="action-row" method="GET" style="margin-bottom:16px"><input class="input" style="max-width:420px" type="search" name="q" value="<?php echo e($keyword); ?>" placeholder="Cari kerusakan..."><button class="btn btn-light">Cari</button></form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kode</th><th>Kerusakan</th><th>Kategori</th><th>Solusi</th><th>Aksi</th></tr></thead><tbody>
<?php $__currentLoopData = $kerusakans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kerusakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><span class="code"><?php echo e($kerusakan->kode_kerusakan); ?></span></td><td><strong><?php echo e($kerusakan->nama_kerusakan); ?></strong><br><small><?php echo e($kerusakan->deskripsi); ?></small></td><td><span class="badge"><?php echo e($kerusakan->kategori); ?></span></td><td><?php echo e(\Illuminate\Support\Str::limit($kerusakan->solusi, 90)); ?></td><td class="action-row"><a class="btn btn-warning" href="<?php echo e(route('admin.kerusakan.edit', $kerusakan)); ?>">Edit</a><form method="POST" action="<?php echo e(route('admin.kerusakan.destroy', $kerusakan)); ?>" data-confirm="Hapus kerusakan ini?"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger">Hapus</button></form></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div>
<?php echo e($kerusakans->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/kerusakan/index.blade.php ENDPATH**/ ?>