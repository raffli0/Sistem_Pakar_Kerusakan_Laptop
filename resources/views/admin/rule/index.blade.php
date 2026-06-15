@extends('layouts.admin')
@section('title', 'Rule Basis Pengetahuan')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>Rule & Certainty Factor</h1><p>Hubungkan gejala dengan kerusakan dan bobot keyakinan pakar.</p></div><a class="btn btn-primary" href="{{ route('admin.rule.create') }}">Tambah Rule</a></div>
<form class="action-row" method="GET" style="margin-bottom:16px"><input class="input" style="max-width:420px" type="search" name="q" value="{{ $keyword }}" placeholder="Cari rule..."><button class="btn btn-light">Cari</button></form>
<div class="table-wrap"><table class="table"><thead><tr><th>Kerusakan</th><th>Gejala</th><th>CF Pakar</th><th>Aksi</th></tr></thead><tbody>
@foreach($rules as $rule)
<tr><td><span class="code">{{ $rule->kerusakan->kode_kerusakan }}</span> {{ $rule->kerusakan->nama_kerusakan }}</td><td><span class="code">{{ $rule->gejala->kode_gejala }}</span> {{ $rule->gejala->nama_gejala }}</td><td><strong>{{ $rule->cf_pakar }}</strong></td><td class="action-row"><a class="btn btn-warning" href="{{ route('admin.rule.edit', $rule) }}">Edit</a><form method="POST" action="{{ route('admin.rule.destroy', $rule) }}" data-confirm="Hapus rule ini?">@csrf @method('DELETE')<button class="btn btn-danger">Hapus</button></form></td></tr>
@endforeach
</tbody></table></div>
{{ $rules->links() }}
@endsection
