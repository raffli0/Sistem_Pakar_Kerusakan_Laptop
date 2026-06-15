<?php $__env->startSection('title', 'Hasil Diagnosa'); ?>
<?php $__env->startSection('content'); ?>
<section class="form-shell">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Hasil Diagnosa</h2>
                <p>Nama: <strong><?php echo e($konsultasi->nama_pengguna); ?></strong> · Tanggal: <?php echo e($konsultasi->tanggal->format('d/m/Y H:i')); ?></p>
            </div>
            <div class="action-row no-print">
                <a class="btn btn-light" href="<?php echo e(route('consultation.print', $konsultasi)); ?>" target="_blank">Cetak</a>
                <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>">Konsultasi Ulang</a>
            </div>
        </div>

        <div class="result-hero">
            <div class="card">
                <div class="score-circle" style="--score: <?php echo e(min($konsultasi->nilai_cf, 100)); ?>%"><strong><?php echo e(number_format($konsultasi->nilai_cf, 2)); ?>%</strong></div>
                <p style="text-align:center;margin-top:18px;color:var(--muted);font-weight:800">Tingkat Keyakinan Diagnosa Utama</p>
            </div>
            <div class="card">
                <span class="badge badge-blue"><?php echo e($konsultasi->hasilUtama->kategori); ?></span>
                <h2 style="margin:12px 0 8px"><?php echo e($konsultasi->hasilUtama->nama_kerusakan); ?></h2>
                <p><?php echo e($konsultasi->hasilUtama->deskripsi); ?></p>
                <h3>Kemungkinan Penyebab</h3>
                <p><?php echo e($konsultasi->hasilUtama->penyebab); ?></p>
                <h3>Solusi Awal</h3>
                <p><?php echo e($konsultasi->hasilUtama->solusi); ?></p>
            </div>
        </div>

        <div class="section" style="padding-bottom:0">
            <div class="section-title"><div><h2>Gejala yang Dipilih</h2><p>Daftar fakta/gejala dari pengguna yang menjadi dasar proses inferensi.</p></div></div>
            <div class="table-wrap">
                <table class="table">
                    <thead><tr><th>Kode</th><th>Gejala</th><th>Kategori</th><th>CF User</th></tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $konsultasi->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><span class="code"><?php echo e($detail->gejala->kode_gejala); ?></span></td><td><?php echo e($detail->gejala->nama_gejala); ?></td><td><?php echo e($detail->gejala->kategori); ?></td><td><?php echo e($detail->cf_user); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <div class="section-title"><div><h2>Alternatif Hasil Diagnosa</h2><p>Sistem mengurutkan kemungkinan kerusakan dari nilai Certainty Factor tertinggi.</p></div></div>
            <div class="table-wrap">
                <table class="table">
                    <thead><tr><th>Kerusakan</th><th>Kategori</th><th>CF</th><th>Progress</th><th>Gejala Cocok</th></tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $konsultasi->hasilDiagnosa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hasil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($hasil->kerusakan->nama_kerusakan); ?></strong></td>
                            <td><span class="badge"><?php echo e($hasil->kerusakan->kategori); ?></span></td>
                            <td><strong><?php echo e(number_format($hasil->nilai_cf, 2)); ?>%</strong></td>
                            <td><div class="progress"><span style="width: <?php echo e(min($hasil->nilai_cf, 100)); ?>%"></span></div></td>
                            <td>
                                <?php $__currentLoopData = ($hasil->gejala_cocok_json ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><span class="code"><?php echo e($g['kode']); ?></span> <?php echo e($g['nama']); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/consultation/result.blade.php ENDPATH**/ ?>