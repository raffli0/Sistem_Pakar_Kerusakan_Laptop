<?php $__env->startSection('title', 'Konsultasi Kerusakan Laptop'); ?>
<?php $__env->startSection('content'); ?>
<section class="form-shell">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Konsultasi Kerusakan Laptop</h2>
                <p>Pilih gejala yang dialami dan tingkat keyakinan kamu. Sistem akan menghitung diagnosa dengan Forward Chaining dan Certainty Factor.</p>
            </div>
            <span class="badge badge-blue" data-selected-counter>0 gejala dipilih</span>
        </div>
        <form class="form-card" method="POST" action="<?php echo e(route('consultation.process')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="label">Nama Pengguna</label>
                <input class="input" type="text" name="nama_pengguna" value="<?php echo e(old('nama_pengguna')); ?>" placeholder="Masukkan nama kamu" required>
            </div>
            <div class="symptom-toolbar">
                <input class="input" type="search" placeholder="Cari gejala, kode, atau kategori..." data-symptom-search>
                <button type="submit" class="btn btn-primary">Proses Diagnosa</button>
            </div>

            <?php $__currentLoopData = $gejalas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="symptom-category">
                    <h3 class="category-title"><span class="badge badge-blue"><?php echo e($kategori); ?></span></h3>
                    <div class="symptom-grid">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gejala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="symptom-card" data-symptom-card>
                                <div class="symptom-head">
                                    <span class="code"><?php echo e($gejala->kode_gejala); ?></span>
                                    <div class="symptom-name"><?php echo e($gejala->nama_gejala); ?></div>
                                </div>
                                <div class="cf-row">
                                    <label class="label" style="font-size:13px;margin-bottom:0">Tingkat keyakinan</label>
                                    <select class="select" name="gejala[<?php echo e($gejala->id); ?>]" data-cf-select>
                                        <option value="0">Tidak / Tidak dialami</option>
                                        <option value="0.2">Tidak tahu</option>
                                        <option value="0.4">Sedikit yakin</option>
                                        <option value="0.6">Cukup yakin</option>
                                        <option value="0.8">Yakin</option>
                                        <option value="1.0">Sangat yakin</option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="action-row" style="justify-content:flex-end;margin-top:22px">
                <button type="reset" class="btn btn-light">Reset</button>
                <button type="submit" class="btn btn-primary">Proses Diagnosa</button>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/consultation/create.blade.php ENDPATH**/ ?>