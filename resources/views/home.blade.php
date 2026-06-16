@extends('layouts.app')
@section('title', 'Sistem Pakar Diagnosa Kerusakan Laptop')
@section('content')

{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="container hero-grid">
        <div>
            <div class="eyebrow">⚙️ Forward Chaining + Certainty Factor</div>
            <h1>Diagnosa awal kerusakan hardware dan software laptop.</h1>
            <p>Sistem pakar berbasis web untuk membantu pengguna mengetahui kemungkinan kerusakan laptop dari gejala yang dipilih, lengkap dengan persentase keyakinan dan solusi awal.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('consultation.create') }}">Mulai Konsultasi →</a>
                <a class="btn btn-light" href="{{ route('admin.login') }}">Masuk sebagai Pakar</a>
            </div>
        </div>
        <div class="hero-card diagnosis-preview">
            <div class="metric">
                <span>Basis Gejala</span>
                <strong>{{ $jumlahGejala }}</strong>
            </div>
            <div class="metric">
                <span>Jenis Kerusakan</span>
                <strong>{{ $jumlahKerusakan }}</strong>
            </div>
            <div class="metric">
                <span>Rule Pakar</span>
                <strong>{{ $jumlahRule }}</strong>
            </div>
            <div>
                <div style="display:flex;justify-content:space-between;font-weight:900;font-size:13px;margin-bottom:8px">
                    <span>Contoh keyakinan diagnosa</span><span>86%</span>
                </div>
                <div class="progress"><span style="width:86%"></span></div>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ============ STATS ============ --}}
<section class="section" style="padding-top:0;padding-bottom:0">
    <div class="container" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
        <div class="stat-card" data-animate="zoom-in" data-delay="100">
            <span>Basis Gejala</span>
            <strong>{{ $jumlahGejala }}</strong>
        </div>
        <div class="stat-card" data-animate="zoom-in" data-delay="250">
            <span>Jenis Kerusakan</span>
            <strong>{{ $jumlahKerusakan }}</strong>
        </div>
        <div class="stat-card" data-animate="zoom-in" data-delay="400">
            <span>Rule &amp; CF</span>
            <strong>{{ $jumlahRule }}</strong>
        </div>
        <div class="stat-card" data-animate="zoom-in" data-delay="550">
            <span>Sesi Konsultasi</span>
            <strong>{{ $jumlahKonsultasi }}</strong>
        </div>
    </div>
</section>

<div class="section-divider" style="margin-top:56px"></div>

{{-- ============ HOW IT WORKS ============ --}}
<section class="section">
    <div class="container">
        <div class="section-title" data-animate="fade-up">
            <div>
                <h2>Bagaimana sistem pakar ini bekerja?</h2>
                <p>Tiga langkah sederhana untuk mendapatkan diagnosa kerusakan laptop yang akurat.</p>
            </div>
        </div>
        <div class="grid-3">
            <div class="card" data-animate="fade-up" data-delay="100">
                <div class="icon-box">1</div>
                <h3>Pilih Gejala</h3>
                <p>Geser slider tingkat keyakinan untuk setiap gejala yang kamu rasakan, seperti laptop cepat panas, blue screen, layar gelap, atau baterai tidak mengisi.</p>
            </div>
            <div class="card" data-animate="fade-up" data-delay="300">
                <div class="icon-box">2</div>
                <h3>Proses Inferensi</h3>
                <p>Forward Chaining mencocokkan gejala yang dipilih dengan rule IF-THEN dalam basis pengetahuan, kemudian menelusuri kemungkinan kerusakan yang paling relevan.</p>
            </div>
            <div class="card" data-animate="fade-up" data-delay="500">
                <div class="icon-box">3</div>
                <h3>Hasil Diagnosa</h3>
                <p>Certainty Factor menghitung dan menggabungkan nilai keyakinan setiap gejala. Sistem memberi daftar kerusakan beserta persentase keyakinan dan solusi awal.</p>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ============ FEATURES ============ --}}
<section class="section">
    <div class="container">
        <div class="section-title" data-animate="fade-right">
            <div>
                <h2>Fitur unggulan sistem</h2>
                <p>Dirancang untuk pengguna awam maupun teknisi dengan akurasi tinggi dari basis pengetahuan pakar.</p>
            </div>
        </div>
        <div class="grid-3">
            <div class="feature-card" data-animate="fade-up" data-delay="100">
                <div class="feature-icon" style="background:#eff6ff">🧠</div>
                <h3>Basis Pengetahuan Pakar</h3>
                <p>Gejala, kerusakan, dan rule CF dikurasi langsung oleh teknisi laptop berpengalaman untuk hasil diagnosa yang tepat sasaran.</p>
            </div>
            <div class="feature-card" data-animate="fade-up" data-delay="250">
                <div class="feature-icon" style="background:#f0fdf4">⚡</div>
                <h3>Diagnosa Real-time</h3>
                <p>Proses inferensi selesai dalam hitungan detik. Tidak perlu tunggu lama, langsung dapat hasil berikut persentase keyakinan untuk setiap kemungkinan kerusakan.</p>
            </div>
            <div class="feature-card" data-animate="fade-up" data-delay="400">
                <div class="feature-icon" style="background:#fff7ed">📊</div>
                <h3>Multi-Diagnosa dengan Ranking</h3>
                <p>Sistem tidak hanya memberi satu jawaban — semua kemungkinan kerusakan yang relevan ditampilkan lengkap dengan peringkat dan nilai keyakinannya.</p>
            </div>
            <div class="feature-card" data-animate="fade-up" data-delay="150">
                <div class="feature-icon" style="background:#fdf4ff">🎚️</div>
                <h3>Tingkat Keyakinan User</h3>
                <p>Pengguna bisa mengatur seberapa yakin mereka dengan setiap gejala melalui slider interaktif — menjadikan diagnosa jauh lebih personal dan akurat.</p>
            </div>
            <div class="feature-card" data-animate="fade-up" data-delay="300">
                <div class="feature-icon" style="background:#f0f9ff">🖨️</div>
                <h3>Ekspor Laporan Cetak</h3>
                <p>Hasil diagnosa dapat dicetak langsung sebagai laporan formal, berguna untuk dibawa ke teknisi atau pusat servis laptop.</p>
            </div>
            <div class="feature-card" data-animate="fade-up" data-delay="450">
                <div class="feature-icon" style="background:#fef9c3">🔒</div>
                <h3>Panel Admin Terproteksi</h3>
                <p>Pakar dapat mengelola basis pengetahuan, memperbarui rule dan CF, serta memantau seluruh riwayat konsultasi melalui panel admin yang aman.</p>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ============ CTA BANNER ============ --}}
<section class="section" style="padding-top:0">
    <div class="container">
        <div class="cta-banner" data-animate="zoom-in">
            <h2>Siap mendiagnosa kerusakan laptop kamu?</h2>
            <p>Mulai konsultasi sekarang — gratis, cepat, dan akurat berdasarkan basis pengetahuan pakar.</p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
                <a class="btn btn-light" href="{{ route('consultation.create') }}" style="font-size:16px;padding:14px 28px">
                    Mulai Konsultasi →
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
