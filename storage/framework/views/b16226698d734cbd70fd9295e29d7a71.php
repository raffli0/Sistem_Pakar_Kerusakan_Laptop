<?php $__env->startSection('title', 'Sistem Pakar Diagnosa Kerusakan Laptop'); ?>
<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <div class="eyebrow">Forward Chaining + Certainty Factor</div>
            <h1>Diagnosa awal kerusakan hardware dan software laptop.</h1>
            <p>Sistem pakar berbasis web untuk membantu pengguna mengetahui kemungkinan kerusakan laptop dari gejala yang dipilih, lengkap dengan persentase keyakinan dan solusi awal.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="<?php echo e(route('consultation.create')); ?>">Mulai Konsultasi</a>
                <a class="btn btn-light" href="<?php echo e(route('admin.login')); ?>">Masuk Admin/Pakar</a>
            </div>
        </div>
        <div class="hero-card diagnosis-preview">
            <div class="metric"><span>Basis Gejala</span><strong><?php echo e($jumlahGejala); ?></strong></div>
            <div class="metric"><span>Jenis Kerusakan</span><strong><?php echo e($jumlahKerusakan); ?></strong></div>
            <div class="metric"><span>Rule Pakar</span><strong><?php echo e($jumlahRule); ?></strong></div>
            <div>
                <div style="display:flex;justify-content:space-between;font-weight:900;margin-bottom:8px"><span>Contoh keyakinan</span><span>86%</span></div>
                <div class="progress"><span style="width:86%"></span></div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Alur sistem pakar</h2>
                <p>Sistem bekerja dari gejala yang diketahui user, kemudian melakukan pencocokan rule dan menghitung nilai keyakinan.</p>
            </div>
        </div>
        <div class="grid-3">
            <div class="card"><div class="icon-box">1</div><h3>Pilih Gejala</h3><p>User memilih gejala seperti laptop cepat panas, blue screen, layar gelap, atau baterai tidak mengisi.</p></div>
            <div class="card"><div class="icon-box">2</div><h3>Proses Inferensi</h3><p>Forward Chaining mencocokkan gejala dengan rule IF-THEN pada basis pengetahuan pakar.</p></div>
            <div class="card"><div class="icon-box">3</div><h3>Hasil Diagnosa</h3><p>Certainty Factor menghitung persentase keyakinan, lalu sistem memberi solusi awal.</p></div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="container grid-4">
        <div class="stat-card"><span>Gejala</span><strong><?php echo e($jumlahGejala); ?></strong></div>
        <div class="stat-card"><span>Kerusakan</span><strong><?php echo e($jumlahKerusakan); ?></strong></div>
        <div class="stat-card"><span>Rule</span><strong><?php echo e($jumlahRule); ?></strong></div>
        <div class="stat-card"><span>Konsultasi</span><strong><?php echo e($jumlahKonsultasi); ?></strong></div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Agung Candra\Downloads\Compressed\sistem-pakar-laptop-laravel-mysql-migration\sistem-pakar-laravel\resources\views/home.blade.php ENDPATH**/ ?>