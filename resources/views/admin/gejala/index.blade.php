@extends('layouts.admin')
@section('title', 'Data Gejala')
@section('content')
<div class="admin-top">
    <div class="admin-title"><h1>Data Gejala</h1><p>Kelola gejala kerusakan laptop.</p></div>
    <a class="btn btn-primary" href="{{ route('admin.gejala.create') }}">Tambah Gejala</a>
</div>
<form class="action-row" method="GET" style="margin-bottom:16px">
    <input class="input" style="max-width:420px" type="search" name="q" value="{{ $keyword }}" placeholder="Cari gejala...">
    <button class="btn btn-light">Cari</button>
</form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kode</th><th>Nama Gejala</th><th>Kategori</th><th>Aksi</th></tr></thead><tbody>
@foreach($gejala as $item)
<tr><td><span class="code">{{ $item->kode_gejala }}</span></td><td>{{ $item->nama_gejala }}</td><td><span class="badge">{{ $item->kategori }}</span></td><td class="action-row"><a class="btn btn-warning" href="{{ route('admin.gejala.edit', $item) }}">Edit</a><form method="POST" action="{{ route('admin.gejala.destroy', $item) }}" data-confirm="Hapus gejala ini?">@csrf @method('DELETE')<button class="btn btn-danger">Hapus</button></form></td></tr>
@endforeach
</tbody></table></div>
{{ $gejala->links() }}
@endsection
