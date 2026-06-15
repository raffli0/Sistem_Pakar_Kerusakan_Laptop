@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Gejala' : 'Edit Gejala')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>{{ $mode === 'create' ? 'Tambah Gejala' : 'Edit Gejala' }}</h1><p>Isi data gejala kerusakan laptop.</p></div></div>
<form class="form-card" method="POST" action="{{ $mode === 'create' ? route('admin.gejala.store') : route('admin.gejala.update', $gejala) }}">
    @csrf @if($mode === 'edit') @method('PUT') @endif
    <div class="form-group"><label class="label">Kode Gejala</label><input class="input" name="kode_gejala" value="{{ old('kode_gejala', $gejala->kode_gejala) }}" placeholder="G31" required></div>
    <div class="form-group"><label class="label">Nama Gejala</label><input class="input" name="nama_gejala" value="{{ old('nama_gejala', $gejala->nama_gejala) }}" required></div>
    <div class="form-group"><label class="label">Kategori</label><input class="input" name="kategori" value="{{ old('kategori', $gejala->kategori) }}" placeholder="Power / Display / Software" required></div>
    <div class="action-row"><button class="btn btn-primary">Simpan</button><a class="btn btn-light" href="{{ route('admin.gejala.index') }}">Kembali</a></div>
</form>
@endsection
