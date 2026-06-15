@extends('layouts.app')
@section('title', 'Cetak Hasil Diagnosa')
@section('content')
<section class="form-shell">
    <div class="container">
        <div class="card">
            <div class="action-row no-print" style="justify-content:flex-end"><button class="btn btn-primary" onclick="window.print()">Print</button></div>
            <h1>Hasil Diagnosa Kerusakan Laptop</h1>
            <p>Nama: <strong>{{ $konsultasi->nama_pengguna }}</strong></p>
            <p>Tanggal: {{ $konsultasi->tanggal->format('d/m/Y H:i') }}</p>
            <hr>
            <h2>{{ $konsultasi->hasilUtama->nama_kerusakan }}</h2>
            <p><strong>Tingkat Keyakinan:</strong> {{ number_format($konsultasi->nilai_cf, 2) }}%</p>
            <p><strong>Deskripsi:</strong> {{ $konsultasi->hasilUtama->deskripsi }}</p>
            <p><strong>Penyebab:</strong> {{ $konsultasi->hasilUtama->penyebab }}</p>
            <p><strong>Solusi:</strong> {{ $konsultasi->hasilUtama->solusi }}</p>
            <h3>Gejala yang Dipilih</h3>
            <ul>
                @foreach($konsultasi->details as $detail)
                    <li>{{ $detail->gejala->kode_gejala }} - {{ $detail->gejala->nama_gejala }} | CF User: {{ $detail->cf_user }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
