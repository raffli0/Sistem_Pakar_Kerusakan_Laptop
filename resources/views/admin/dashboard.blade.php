@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')
<div class="admin-top">
    <div class="admin-title"><h1>Dashboard Sistem Pakar</h1><p>Ringkasan basis pengetahuan, rule, dan riwayat konsultasi.</p></div>
    <a class="btn btn-primary" href="{{ route('consultation.create') }}">Tes Konsultasi</a>
</div>
<div class="grid-4">
    <div class="stat-card"><span>Total Gejala</span><strong>{{ $jumlahGejala }}</strong></div>
    <div class="stat-card"><span>Total Kerusakan</span><strong>{{ $jumlahKerusakan }}</strong></div>
    <div class="stat-card"><span>Total Rule</span><strong>{{ $jumlahRule }}</strong></div>
    <div class="stat-card"><span>Konsultasi</span><strong>{{ $jumlahKonsultasi }}</strong></div>
</div>
<div class="section">
    <div class="grid-3" style="grid-template-columns:1.2fr .8fr;align-items:start">
        <div class="card">
            <h3>Konsultasi Terbaru</h3>
            <div class="table-wrap" style="margin-top:14px">
                <table class="table">
                    <thead><tr><th>Nama</th><th>Hasil</th><th>CF</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    @forelse($konsultasiTerbaru as $item)
                        <tr><td>{{ $item->nama_pengguna }}</td><td>{{ $item->hasilUtama?->nama_kerusakan }}</td><td>{{ $item->nilai_cf }}%</td><td>{{ $item->tanggal->format('d/m/Y') }}</td></tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">Belum ada konsultasi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <h3>Diagnosa Terbanyak</h3>
            @forelse($topDiagnosa as $item)
                <div class="metric" style="margin-top:12px"><span>{{ $item->kerusakan?->nama_kerusakan }}</span><strong>{{ $item->total }}</strong></div>
            @empty
                <div class="empty-state">Belum ada data.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
