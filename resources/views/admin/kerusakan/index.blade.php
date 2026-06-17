@extends('layouts.admin')
@section('title', 'Data Kerusakan')
@section('content')
<div class="admin-top">
    <div class="admin-title"><h1>Data Kerusakan</h1><p>Kelola jenis kerusakan, penyebab, dan solusi awal.</p></div>
    <a class="btn btn-primary" href="{{ route('admin.kerusakan.create') }}">Tambah Kerusakan</a>
</div>
<form class="action-row" method="GET" style="margin-bottom:16px"><input class="input" style="max-width:420px" type="search" name="q" value="{{ $keyword }}" placeholder="Cari kerusakan..."><button class="btn btn-light">Cari</button></form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kode</th><th>Kerusakan</th><th>Kategori</th><th>Solusi</th><th>Aksi</th></tr></thead><tbody>
@foreach($kerusakan as $item)
<tr><td><span class="code">{{ $item->kode_kerusakan }}</span></td><td><strong>{{ $item->nama_kerusakan }}</strong><br><small>{{ $item->deskripsi }}</small></td><td><span class="badge">{{ $item->kategori }}</span></td><td>{{ \Illuminate\Support\Str::limit($item->solusi, 90) }}</td><td class="action-row"><a class="btn btn-warning" href="{{ route('admin.kerusakan.edit', $item) }}">Edit</a><form method="POST" action="{{ route('admin.kerusakan.destroy', $item) }}" data-confirm="Hapus kerusakan ini?">@csrf @method('DELETE')<button class="btn btn-danger">Hapus</button></form></td></tr>
@endforeach
</tbody></table></div>
{{ $kerusakan->links() }}
@endsection
