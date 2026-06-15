@extends('layouts.app')
@section('title', 'Hasil Diagnosa')
@section('content')
<section class="form-shell">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Hasil Diagnosa</h2>
                <p>Nama: <strong>{{ $konsultasi->nama_pengguna }}</strong> · Tanggal: {{ $konsultasi->tanggal->format('d/m/Y H:i') }}</p>
            </div>
            <div class="action-row no-print">
                <a class="btn btn-light" href="{{ route('consultation.print', $konsultasi) }}" target="_blank">Cetak</a>
                <a class="btn btn-primary" href="{{ route('consultation.create') }}">Konsultasi Ulang</a>
            </div>
        </div>

        <div class="result-hero">
            <div class="card">
                <div class="score-circle" style="--score: {{ min($konsultasi->nilai_cf, 100) }}%"><strong>{{ number_format($konsultasi->nilai_cf, 2) }}%</strong></div>
                <p style="text-align:center;margin-top:18px;color:var(--muted);font-weight:800">Tingkat Keyakinan Diagnosa Utama</p>
            </div>
            <div class="card">
                <span class="badge badge-blue">{{ $konsultasi->hasilUtama->kategori }}</span>
                <h2 style="margin:12px 0 8px">{{ $konsultasi->hasilUtama->nama_kerusakan }}</h2>
                <p>{{ $konsultasi->hasilUtama->deskripsi }}</p>
                <h3>Kemungkinan Penyebab</h3>
                <p>{{ $konsultasi->hasilUtama->penyebab }}</p>
                <h3>Solusi Awal</h3>
                <p>{{ $konsultasi->hasilUtama->solusi }}</p>
            </div>
        </div>

        <div class="section" style="padding-bottom:0">
            <div class="section-title"><div><h2>Gejala yang Dipilih</h2><p>Daftar fakta/gejala dari pengguna yang menjadi dasar proses inferensi.</p></div></div>
            <div class="table-wrap">
                <table class="table">
                    <thead><tr><th>Kode</th><th>Gejala</th><th>Kategori</th><th>CF User</th></tr></thead>
                    <tbody>
                    @foreach($konsultasi->details as $detail)
                        <tr><td><span class="code">{{ $detail->gejala->kode_gejala }}</span></td><td>{{ $detail->gejala->nama_gejala }}</td><td>{{ $detail->gejala->kategori }}</td><td>{{ $detail->cf_user }}</td></tr>
                    @endforeach
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
                    @foreach($konsultasi->hasilDiagnosa as $hasil)
                        <tr>
                            <td><strong>{{ $hasil->kerusakan->nama_kerusakan }}</strong></td>
                            <td><span class="badge">{{ $hasil->kerusakan->kategori }}</span></td>
                            <td><strong>{{ number_format($hasil->nilai_cf, 2) }}%</strong></td>
                            <td><div class="progress"><span style="width: {{ min($hasil->nilai_cf, 100) }}%"></span></div></td>
                            <td>
                                @foreach(($hasil->gejala_cocok_json ?? []) as $g)
                                    <div><span class="code">{{ $g['kode'] }}</span> {{ $g['nama'] }}</div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
