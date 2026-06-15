@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Rule' : 'Edit Rule')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>{{ $mode === 'create' ? 'Tambah Rule' : 'Edit Rule' }}</h1><p>Rule digunakan dalam proses Forward Chaining dan CF.</p></div></div>
<form class="form-card" method="POST" action="{{ $mode === 'create' ? route('admin.rule.store') : route('admin.rule.update', $rule) }}">
    @csrf @if($mode === 'edit') @method('PUT') @endif
    <div class="form-group"><label class="label">Kerusakan</label><select class="select" name="kerusakan_id" required><option value="">Pilih kerusakan</option>@foreach($kerusakans as $k)<option value="{{ $k->id }}" @selected(old('kerusakan_id', $rule->kerusakan_id)==$k->id)>{{ $k->kode_kerusakan }} - {{ $k->nama_kerusakan }}</option>@endforeach</select></div>
    <div class="form-group"><label class="label">Gejala</label><select class="select" name="gejala_id" required><option value="">Pilih gejala</option>@foreach($gejalas as $g)<option value="{{ $g->id }}" @selected(old('gejala_id', $rule->gejala_id)==$g->id)>{{ $g->kode_gejala }} - {{ $g->nama_gejala }}</option>@endforeach</select></div>
    <div class="form-group"><label class="label">CF Pakar (0 - 1)</label><input class="input" type="number" step="0.01" min="0" max="1" name="cf_pakar" value="{{ old('cf_pakar', $rule->cf_pakar) }}" required></div>
    <div class="action-row"><button class="btn btn-primary">Simpan</button><a class="btn btn-light" href="{{ route('admin.rule.index') }}">Kembali</a></div>
</form>
@endsection
