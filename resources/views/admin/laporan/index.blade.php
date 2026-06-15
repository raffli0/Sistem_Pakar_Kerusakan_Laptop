@extends('layouts.admin')
@section('title', 'Laporan Konsultasi')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>Laporan Konsultasi</h1><p>Filter dan cetak rekap hasil konsultasi.</p></div><button class="btn btn-primary no-print" onclick="window.print()">Cetak Laporan</button></div>
<form class="form-card no-print" method="GET" style="margin-bottom:16px;padding:16px">
    <div class="grid-3" style="align-items:end">
        <div class="form-group" style="margin:0"><label class="label">Tanggal Mulai</label><input class="input" type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Selesai</label><input class="input" type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"></div>
        <button class="btn btn-primary">Terapkan Filter</button>
    </div>
</form>
<div class="grid-3" style="grid-template-columns:1.2fr .8fr;align-items:start">
    <div class="card"><h3>Data Konsultasi</h3><div class="table-wrap" style="margin-top:14px"><table class="table"><thead><tr><th>Nama</th><th>Diagnosa</th><th>CF</th><th>Tanggal</th></tr></thead><tbody>
    @forelse($konsultasis as $item)
        <tr><td>{{ $item->nama_pengguna }}</td><td>{{ $item->hasilUtama?->nama_kerusakan }}</td><td>{{ $item->nilai_cf }}%</td><td>{{ $item->tanggal->format('d/m/Y H:i') }}</td></tr>
    @empty
        <tr><td colspan="4" class="empty-state">Tidak ada data.</td></tr>
    @endforelse
    </tbody></table></div></div>
    <div class="card"><h3>Statistik Diagnosa</h3>
    @forelse($topDiagnosa as $item)
        <div class="metric" style="margin-top:12px"><span>{{ $item->kerusakan?->nama_kerusakan }}<br><small>Rata-rata CF {{ number_format($item->rata_cf, 2) }}%</small></span><strong>{{ $item->total }}</strong></div>
    @empty
        <div class="empty-state">Tidak ada statistik.</div>
    @endforelse
    </div>
</div>
@endsection
