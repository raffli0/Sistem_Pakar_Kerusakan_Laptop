@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Kerusakan' : 'Edit Kerusakan')
@section('content')
<div class="admin-top"><div class="admin-title"><h1>{{ $mode === 'create' ? 'Tambah Kerusakan' : 'Edit Kerusakan' }}</h1><p>Isi detail kerusakan, penyebab, dan solusi.</p></div></div>
<form class="form-card" method="POST" action="{{ $mode === 'create' ? route('admin.kerusakan.store') : route('admin.kerusakan.update', $kerusakan) }}">
    @csrf @if($mode === 'edit') @method('PUT') @endif
    <div class="grid-3" style="grid-template-columns:1fr 2fr 1fr">
        <div class="form-group"><label class="label">Kode</label><input class="input" name="kode_kerusakan" value="{{ old('kode_kerusakan', $kerusakan->kode_kerusakan) }}" required></div>
        <div class="form-group"><label class="label">Nama Kerusakan</label><input class="input" name="nama_kerusakan" value="{{ old('nama_kerusakan', $kerusakan->nama_kerusakan) }}" required></div>
        <div class="form-group"><label class="label">Kategori</label><input class="input" name="kategori" value="{{ old('kategori', $kerusakan->kategori) }}" required></div>
    </div>
    <div class="form-group"><label class="label">Deskripsi</label><textarea class="textarea" name="deskripsi">{{ old('deskripsi', $kerusakan->deskripsi) }}</textarea></div>
    <div class="form-group"><label class="label">Penyebab</label><textarea class="textarea" name="penyebab">{{ old('penyebab', $kerusakan->penyebab) }}</textarea></div>
    <div class="form-group"><label class="label">Solusi Awal</label><textarea class="textarea" name="solusi">{{ old('solusi', $kerusakan->solusi) }}</textarea></div>
    <div class="action-row"><button class="btn btn-primary">Simpan</button><a class="btn btn-light" href="{{ route('admin.kerusakan.index') }}">Kembali</a></div>
</form>
@endsection
