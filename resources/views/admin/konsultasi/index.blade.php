@extends('layouts.admin')
@section('title', 'Riwayat Konsultasi')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>Riwayat Konsultasi</h1><p>Data hasil konsultasi pengguna.</p></div></div>
<form class="form-card" method="GET" style="margin-bottom:16px;padding:16px">
    <div class="grid-4" style="align-items:end">
        <div class="form-group" style="margin:0"><label class="label">Cari Nama</label><input class="input" name="q" value="{{ request('q') }}" placeholder="Nama pengguna"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Mulai</label><input class="input" type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"></div>
        <div class="form-group" style="margin:0"><label class="label">Tanggal Selesai</label><input class="input" type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"></div>
        <button class="btn btn-primary">Filter</button>
    </div>
</form>
<div class="table-wrap"><table class="table"><thead><tr><th>Nama</th><th>Hasil Utama</th><th>CF</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
@forelse($konsultasis as $item)
<tr><td>{{ $item->nama_pengguna }}</td><td><strong>{{ $item->hasilUtama?->nama_kerusakan }}</strong></td><td>{{ $item->nilai_cf }}%</td><td>{{ $item->tanggal->format('d/m/Y H:i') }}</td><td class="action-row"><a class="btn btn-light" href="{{ route('admin.konsultasi.show', $item) }}">Detail</a><form method="POST" action="{{ route('admin.konsultasi.destroy', $item) }}" data-confirm="Hapus riwayat ini?">@csrf @method('DELETE')<button class="btn btn-danger">Hapus</button></form></td></tr>
@empty
<tr><td colspan="5" class="empty-state">Belum ada konsultasi.</td></tr>
@endforelse
</tbody></table></div>
{{ $konsultasis->links() }}
@endsection
