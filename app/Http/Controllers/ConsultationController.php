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
        $validated = $request->validate([
            'nama_pengguna' => ['required', 'string', 'max:100'],
            'gejala' => ['required', 'array'],
            'gejala.*' => ['nullable', 'numeric', 'min:0', 'max:1'],
        ]);

        $selected = collect($validated['gejala'])
            ->map(fn ($value) => (float) $value)
            ->filter(fn ($value) => $value > 0);

        if ($selected->isEmpty()) {
            return back()->withInput()->with('error', 'Pilih minimal satu gejala dengan tingkat keyakinan lebih dari 0.');
        }

        $rules = Rule::with(['kerusakan', 'gejala'])
            ->whereIn('gejala_id', $selected->keys()->all())
            ->get();

        if ($rules->isEmpty()) {
            return back()->withInput()->with('error', 'Belum ada rule yang cocok dengan gejala yang dipilih.');
        }

        $hasil = [];

        foreach ($rules as $rule) {
            $cfUser = (float) $selected[$rule->gejala_id];
            $cfPakar = (float) $rule->cf_pakar;
            $cfGejala = $cfUser * $cfPakar;
            $kerusakanId = $rule->kerusakan_id;

            if (!isset($hasil[$kerusakanId])) {
                $hasil[$kerusakanId] = [
                    'kerusakan' => $rule->kerusakan,
                    'cf' => $cfGejala,
                    'gejala' => [[
                        'kode' => $rule->gejala->kode_gejala,
                        'nama' => $rule->gejala->nama_gejala,
                        'cf_user' => $cfUser,
                        'cf_pakar' => $cfPakar,
                        'cf_gejala' => $cfGejala,
                    ]],
                ];
            } else {
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

        $sorted = collect($hasil)->sortByDesc('cf')->values();
        $utama = $sorted->first();

        $konsultasi = DB::transaction(function () use ($validated, $selected, $sorted, $utama) {
            $konsultasi = Konsultasi::create([
                'nama_pengguna' => $validated['nama_pengguna'],
                'tanggal' => now(),
                'hasil_kerusakan_id' => $utama['kerusakan']->id,
                'nilai_cf' => round($utama['cf'] * 100, 2),
            ]);

            foreach ($selected as $gejalaId => $cfUser) {
                DetailKonsultasi::create([
                    'konsultasi_id' => $konsultasi->id,
                    'gejala_id' => $gejalaId,
                    'cf_user' => $cfUser,
                ]);
            }

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
