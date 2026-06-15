@extends('layouts.admin')
@section('title', 'Detail Konsultasi')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>Detail Konsultasi</h1><p>{{ $konsultasi->nama_pengguna }} · {{ $konsultasi->tanggal->format('d/m/Y H:i') }}</p></div><a class="btn btn-light" href="{{ route('admin.konsultasi.index') }}">Kembali</a></div>
<div class="result-hero">
    <div class="card"><div class="score-circle" style="--score: {{ min($konsultasi->nilai_cf, 100) }}%"><strong>{{ $konsultasi->nilai_cf }}%</strong></div></div>
    <div class="card"><span class="badge badge-blue">{{ $konsultasi->hasilUtama->kategori }}</span><h2>{{ $konsultasi->hasilUtama->nama_kerusakan }}</h2><p>{{ $konsultasi->hasilUtama->deskripsi }}</p><h3>Solusi</h3><p>{{ $konsultasi->hasilUtama->solusi }}</p></div>
</div>
<div class="section" style="padding-bottom:0"><h2>Hasil Alternatif</h2><div class="table-wrap"><table class="table"><thead><tr><th>Kerusakan</th><th>CF</th><th>Gejala Cocok</th></tr></thead><tbody>
@foreach($konsultasi->hasilDiagnosa as $hasil)
<tr><td>{{ $hasil->kerusakan->nama_kerusakan }}</td><td>{{ $hasil->nilai_cf }}%</td><td>@foreach($hasil->gejala_cocok_json ?? [] as $g)<div><span class="code">{{ $g['kode'] }}</span> {{ $g['nama'] }}</div>@endforeach</td></tr>
@endforeach
</tbody></table></div></div>
@endsection
