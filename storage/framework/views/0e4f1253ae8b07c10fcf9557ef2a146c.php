<?php $__env->startSection('title', 'Data Gejala'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top">
    <div class="admin-title"><h1>Data Gejala</h1><p>Kelola gejala kerusakan laptop.</p></div>
    <a class="btn btn-primary" href="<?php echo e(route('admin.gejala.create')); ?>">Tambah Gejala</a>
</div>
<form class="action-row" method="GET" style="margin-bottom:16px">
    <input class="input" style="max-width:420px" type="search" name="q" value="<?php echo e($keyword); ?>" placeholder="Cari gejala...">
    <button class="btn btn-light">Cari</button>
</form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kode</th><th>Nama Gejala</th><th>Kategori</th><th>Aksi</th></tr></thead><tbody>
<?php $__currentLoopData = $gejalas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gejala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><span class="code"><?php echo e($gejala->kode_gejala); ?></span></td><td><?php echo e($gejala->nama_gejala); ?></td><td><span class="badge"><?php echo e($gejala->kategori); ?></span></td><td class="action-row"><a class="btn btn-warning" href="<?php echo e(route('admin.gejala.edit', $gejala)); ?>">Edit</a><form method="POST" action="<?php echo e(route('admin.gejala.destroy', $gejala)); ?>" data-confirm="Hapus gejala ini?"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger">Hapus</button></form></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div>
<?php echo e($gejalas->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/gejala/index.blade.php ENDPATH**/ ?>