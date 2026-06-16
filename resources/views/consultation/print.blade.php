<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Hasil Diagnosa - {{ $konsultasi->nama_pengguna }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            margin: 40px auto;
            max-width: 800px;
            line-height: 1.5;
            padding: 0 20px;
        }
        h1, h2, h3, h4 {
            font-family: 'Outfit', sans-serif;
            color: #123c69;
            margin-top: 0;
        }
        .header {
            border-bottom: 3px double #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-title h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
        }
        .header-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
        }
        .meta-grid div span {
            color: #64748b;
            font-weight: 600;
            display: block;
            margin-bottom: 2px;
            font-size: 12px;
            text-transform: uppercase;
        }
        .meta-grid div strong {
            font-size: 15px;
            color: #1e293b;
        }
        .result-box {
            border: 2px solid #1c75bc;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 30px;
            background: #f0f9ff;
            position: relative;
        }
        .result-box h2 {
            margin-bottom: 15px;
            color: #1e3a8a;
            font-size: 22px;
            font-weight: 800;
        }
        .cf-badge {
            position: absolute;
            top: 24px;
            right: 24px;
            background: #1c75bc;
            color: white;
            padding: 8px 14px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(28, 117, 188, 0.2);
        }
        .section-title {
            border-left: 4px solid #1c75bc;
            padding-left: 10px;
            margin: 30px 0 15px;
            font-size: 18px;
            font-weight: 700;
        }
        .info-block {
            margin-bottom: 15px;
        }
        .info-block strong {
            display: block;
            margin-bottom: 4px;
            color: #334155;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .info-block p {
            margin: 0;
            color: #475569;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 13px;
        }
        table th, table td {
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
        }
        table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
        }
        .badge {
            background: #e2e8f0;
            color: #334155;
            padding: 3px 8px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-primary {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .toolbar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 700;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background: #1c75bc;
            color: white;
            box-shadow: 0 4px 12px rgba(28, 117, 188, 0.2);
        }
        .btn-light {
            background: white;
            color: #1e293b;
            border: 1px solid #cbd5e1;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .code {
            font-size: 11px;
            font-weight: 800;
            color: #1d4ed8;
            background: #eff6ff;
            border-radius: 4px;
            padding: 2px 6px;
            border: 1px solid #bfdbfe;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 20px auto;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="toolbar no-print">
        <a href="{{ route('consultation.result', $konsultasi) }}" class="btn btn-light">← Kembali ke Hasil</a>
        <button class="btn btn-primary" onclick="window.print()">Cetak Sekarang</button>
    </div>

    <div class="header">
        <div class="header-title">
            <h1>SISTEM PAKAR LAPTOP</h1>
            <p>Diagnosa Kerusakan Hardware & Software Laptop</p>
        </div>
        <div style="text-align: right;">
            <span class="badge badge-primary" style="font-size: 12px; padding: 6px 12px;">LAPORAN DIAGNOSA</span>
        </div>
    </div>

    <div class="meta-grid">
        <div>
            <span>Nama Pengguna</span>
            <strong>{{ $konsultasi->nama_pengguna }}</strong>
        </div>
        <div>
            <span>Tanggal Konsultasi</span>
            <strong>{{ $konsultasi->tanggal->format('d F Y - H:i') }} WIB</strong>
        </div>
    </div>

    <div class="result-box">
        <div class="cf-badge">{{ number_format($konsultasi->nilai_cf, 2) }}% Keyakinan</div>
        <span class="badge badge-primary" style="margin-bottom: 8px;">Diagnosa Utama</span>
        <h2>{{ $konsultasi->hasilUtama->nama_kerusakan }}</h2>
        
        <div class="info-block" style="margin-top: 15px;">
            <strong>Kategori Kerusakan</strong>
            <p>{{ $konsultasi->hasilUtama->kategori }}</p>
        </div>
        
        <div class="info-block">
            <strong>Deskripsi</strong>
            <p style="white-space: pre-line;">{{ $konsultasi->hasilUtama->deskripsi }}</p>
        </div>

        <div class="info-block">
            <strong>Kemungkinan Penyebab</strong>
            <p style="white-space: pre-line;">{{ $konsultasi->hasilUtama->penyebab }}</p>
        </div>

        <div class="info-block" style="margin-bottom: 0;">
            <strong>Solusi Awal Yang Direkomendasikan</strong>
            <p style="font-weight: 500; color: #0f172a; white-space: pre-line;">{{ $konsultasi->hasilUtama->solusi }}</p>
        </div>
    </div>

    <h3 class="section-title">Gejala Yang Dialami</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Kode</th>
                <th style="width: 55%;">Nama Gejala</th>
                <th style="width: 30%;">Tingkat Keyakinan (User)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsultasi->details as $detail)
                <tr>
                    <td><span class="code">{{ $detail->gejala->kode_gejala }}</span></td>
                    <td>{{ $detail->gejala->nama_gejala }}</td>
                    <td>
                        @php
                            $cfLabels = [
                                '0.0' => 'Tidak dialami',
                                '0.2' => 'Tidak tahu',
                                '0.4' => 'Sedikit yakin',
                                '0.6' => 'Cukup yakin',
                                '0.8' => 'Yakin',
                                '1.0' => 'Sangat yakin'
                            ];
                            $valStr = number_format($detail->cf_user, 1);
                            $label = $cfLabels[$valStr] ?? 'Yakin';
                        @endphp
                        <strong>{{ $detail->cf_user }}</strong> <span style="color: #64748b; font-size: 12px; margin-left: 5px;">({{ $label }})</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Alternatif Diagnosa & Probabilitas</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 40%;">Kemungkinan Kerusakan</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 20%;">Nilai Keyakinan</th>
                <th style="width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsultasi->hasilDiagnosa as $index => $hasil)
                <tr>
                    <td><strong>{{ $hasil->kerusakan->nama_kerusakan }}</strong></td>
                    <td>{{ $hasil->kerusakan->kategori }}</td>
                    <td><strong>{{ number_format($hasil->nilai_cf, 2) }}%</strong></td>
                    <td>
                        @if($index === 0)
                            <span class="badge badge-primary">Utama</span>
                        @else
                            <span class="badge">Alternatif</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 15px; text-align: center; font-size: 11px; color: #94a3b8;">
        Laporan ini digenerate secara otomatis oleh Sistem Pakar Kerusakan Laptop menggunakan metode Forward Chaining dan Certainty Factor.
    </div>

    <script>
        // Auto-open print dialog when landing on the page
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
