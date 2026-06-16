@extends('layouts.app')
@section('title', 'Konsultasi Kerusakan Laptop')
@section('content')
<section class="form-shell">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Konsultasi Kerusakan Laptop</h2>
                <p>Geser tingkat keyakinan untuk setiap gejala yang dialami laptop kamu. Sistem akan menghitung diagnosa menggunakan Forward Chaining dan Certainty Factor.</p>
            </div>
            <span class="badge badge-blue" data-selected-counter>0 gejala dipilih</span>
        </div>
        <form class="form-card" method="POST" action="{{ route('consultation.process') }}">
            @csrf
            <div class="form-group">
                <label class="label">Nama Pengguna</label>
                <input class="input" type="text" name="nama_pengguna" value="{{ old('nama_pengguna') }}" placeholder="Masukkan nama kamu" required>
            </div>

            <!-- Sticky Quick Category Navigation -->
            <div class="category-quick-nav no-print">
                @foreach($gejalas as $kategori => $items)
                    <a href="#category-{{ Str::slug($kategori) }}" class="category-nav-link">{{ $kategori }}</a>
                @endforeach
            </div>

            <div class="symptom-toolbar">
                <input class="input" type="search" placeholder="Cari gejala, kode, atau kategori..." data-symptom-search>
                <button type="submit" class="btn btn-primary">Proses Diagnosa</button>
            </div>

            @foreach($gejalas as $kategori => $items)
                <div class="symptom-category" id="category-{{ Str::slug($kategori) }}">
                    <h3 class="category-title"><span class="badge badge-blue" style="font-size: 14px; padding: 6px 14px;">{{ $kategori }}</span></h3>
                    <div class="symptom-grid">
                        @foreach($items as $gejala)
                            <div class="symptom-card" data-symptom-card>
                                <div class="symptom-head">
                                    <span class="code">{{ $gejala->kode_gejala }}</span>
                                    <div class="symptom-name">{{ $gejala->nama_gejala }}</div>
                                </div>
                                <div class="cf-row">
                                    <div class="cf-slider-container">
                                        <div class="cf-slider-header">
                                            <span class="cf-slider-title">Tingkat keyakinan:</span>
                                            <span class="cf-slider-value" data-cf-badge>Tidak dialami</span>
                                        </div>
                                        <input type="range" class="cf-range-input" name="gejala[{{ $gejala->id }}]" min="0" max="1" step="0.2" value="{{ old('gejala.'.$gejala->id, 0) }}" data-cf-range>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="action-row" style="justify-content:flex-end;margin-top:28px">
                <button type="reset" class="btn btn-light">Reset Form</button>
                <button type="submit" class="btn btn-primary">Proses Diagnosa</button>
            </div>
        </form>
    </div>
</section>
@endsection
