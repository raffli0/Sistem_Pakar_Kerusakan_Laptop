<?php $__env->startSection('title', 'Rule Basis Pengetahuan'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-top"><div class="admin-title"><h1>Rule & Certainty Factor</h1><p>Hubungkan gejala dengan kerusakan dan bobot keyakinan pakar.</p></div><a class="btn btn-primary" href="<?php echo e(route('admin.rule.create')); ?>">Tambah Rule</a></div>
<form class="action-row" method="GET" style="margin-bottom:16px"><input class="input" style="max-width:420px" type="search" name="q" value="<?php echo e($keyword); ?>" placeholder="Cari rule..."><button class="btn btn-light">Cari</button></form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kerusakan</th><th>Gejala</th><th>CF Pakar</th><th>Aksi</th></tr></thead><tbody>
<?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><span class="code"><?php echo e($rule->kerusakan->kode_kerusakan); ?></span> <?php echo e($rule->kerusakan->nama_kerusakan); ?></td><td><span class="code"><?php echo e($rule->gejala->kode_gejala); ?></span> <?php echo e($rule->gejala->nama_gejala); ?></td><td><strong><?php echo e($rule->cf_pakar); ?></strong></td><td class="action-row"><a class="btn btn-warning" href="<?php echo e(route('admin.rule.edit', $rule)); ?>">Edit</a><form method="POST" action="<?php echo e(route('admin.rule.destroy', $rule)); ?>" data-confirm="Hapus rule ini?"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger">Hapus</button></form></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div>
<?php echo e($rules->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/admin/rule/index.blade.php ENDPATH**/ ?>