<?php

namespace App\Http\Controllers;

use App\Models\DetailKonsultasi;
use App\Models\DiagnosisResult;
use App\Models\Gejala;
use App\Models\Konsultasi;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function create()
    {
        $gejalas = Gejala::orderBy('kategori')->orderBy('kode_gejala')->get()->groupBy('kategori');
        return view('consultation.create', compact('gejalas'));
    }

    public function process(Request $request)
    {
        // 1. Validasi input data dari user
        $validated = $request->validate([
            'nama_pengguna' => ['required', 'string', 'max:100'],
            'gejala' => ['required', 'array'],
            'gejala.*' => ['nullable', 'numeric', 'min:0', 'max:1'], // Nilai tingkat keyakinan (CF User) antara 0 sampai 1
        ]);

        // Filter gejala yang dipilih (hanya mengambil gejala dengan bobot keyakinan > 0)
        $selected = collect($validated['gejala'])
            ->map(fn($value) => (float) $value)
            ->filter(fn($value) => $value > 0);

        if ($selected->isEmpty()) {
            return back()->withInput()->with('error', 'Pilih minimal satu gejala dengan tingkat keyakinan lebih dari 0.');
        }

        // [FORWARD CHAINING - TAHAP 1]
        // Mencari Rule/Aturan di database yang gejalanya cocok dengan pilihan user (Inference)
        $rules = Rule::with(['kerusakan', 'gejala'])
            ->whereIn('gejala_id', $selected->keys()->all())
            ->get();

        if ($rules->isEmpty()) {
            return back()->withInput()->with('error', 'Belum ada rule yang cocok dengan gejala yang dipilih.');
        }

        $hasil = [];

        // Melakukan penalaran dan perhitungan CF untuk setiap rule yang cocok
        foreach ($rules as $rule) {
            // [CERTAINTY FACTOR - TAHAP 1]
            // Menghitung CF Gejala Tunggal: CF User * CF Pakar
            // Rumus: CF(H,E) = CF(E) * CF(Rule)
            $cfUser = (float) $selected[$rule->gejala_id];
            $cfPakar = (float) $rule->cf_pakar;
            $cfGejala = $cfUser * $cfPakar;
            $kerusakanId = $rule->kerusakan_id;

            // [CERTAINTY FACTOR - TAHAP 2]
            // Menggabungkan nilai CF jika suatu penyakit memiliki lebih dari satu gejala cocok (CF Combine)
            // Rumus: CF_combine = CF_old + CF_new * (1 - CF_old)
            if (!isset($hasil[$kerusakanId])) {
                // Jika gejala pertama untuk penyakit/kerusakan ini ditemukan
                $hasil[$kerusakanId] = [
                    'kerusakan' => $rule->kerusakan,
                    'cf' => $cfGejala,
                    'gejala' => [
                        [
                            'kode' => $rule->gejala->kode_gejala,
                            'nama' => $rule->gejala->nama_gejala,
                            'cf_user' => $cfUser,
                            'cf_pakar' => $cfPakar,
                            'cf_gejala' => $cfGejala,
                        ]
                    ],
                ];
            } else {
                // Jika gejala kedua atau seterusnya untuk kerusakan yang sama ditemukan, lakukan combine
                $cfLama = $hasil[$kerusakanId]['cf'];
                $hasil[$kerusakanId]['cf'] = $cfLama + ($cfGejala * (1 - $cfLama));
                $hasil[$kerusakanId]['gejala'][] = [
                    'kode' => $rule->gejala->kode_gejala,
                    'nama' => $rule->gejala->nama_gejala,
                    'cf_user' => $cfUser,
                    'cf_pakar' => $cfPakar,
                    'cf_gejala' => $cfGejala,
                ];
            }
        }

        // [FORWARD CHAINING - TAHAP 2]
        // Mengurutkan penyakit/kerusakan dari nilai CF terbesar ke terkecil
        // Kesimpulan utama adalah penyakit dengan nilai CF tertinggi (paling atas)
        $sorted = collect($hasil)->sortByDesc('cf')->values();
        $utama = $sorted->first();

        // 3. Menyimpan hasil diagnosis ke database menggunakan database transaction
        $konsultasi = DB::transaction(function () use ($validated, $selected, $sorted, $utama) {
            $konsultasi = Konsultasi::create([
                'nama_pengguna' => $validated['nama_pengguna'],
                'tanggal' => now(),
                'hasil_kerusakan_id' => $utama['kerusakan']->id,
                'nilai_cf' => round($utama['cf'] * 100, 2), // Menyimpan nilai CF dalam bentuk persentase
            ]);

            // Menyimpan detail gejala yang dimasukkan pengguna
            foreach ($selected as $gejalaId => $cfUser) {
                DetailKonsultasi::create([
                    'konsultasi_id' => $konsultasi->id,
                    'gejala_id' => $gejalaId,
                    'cf_user' => $cfUser,
                ]);
            }

            // Menyimpan semua diagnosis alternatif yang cocok beserta perhitungan detail gejalanya
            foreach ($sorted as $item) {
                DiagnosisResult::create([
                    'konsultasi_id' => $konsultasi->id,
                    'kerusakan_id' => $item['kerusakan']->id,
                    'nilai_cf' => round($item['cf'] * 100, 2),
                    'gejala_cocok_json' => $item['gejala'],
                ]);
            }

            return $konsultasi;
        });

        return redirect()->route('consultation.result', $konsultasi);
    }

    public function result(Konsultasi $konsultasi)
    {
        $konsultasi->load(['hasilUtama', 'details.gejala', 'hasilDiagnosa.kerusakan']);
        return view('consultation.result', compact('konsultasi'));
    }

    public function print(Konsultasi $konsultasi)
    {
        $konsultasi->load(['hasilUtama', 'details.gejala', 'hasilDiagnosa.kerusakan']);
        return view('consultation.print', compact('konsultasi'));
    }
}
