<?php

namespace App\Http\Controllers;

use App\Models\DiagnosisResult;
use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Konsultasi;
use App\Models\Rule;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $topDiagnosa = DiagnosisResult::select('kerusakan_id', DB::raw('COUNT(*) as total'))
            ->with('kerusakan')
            ->groupBy('kerusakan_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'jumlahGejala' => Gejala::count(),
            'jumlahKerusakan' => Kerusakan::count(),
            'jumlahRule' => Rule::count(),
            'jumlahKonsultasi' => Konsultasi::count(),
            'konsultasiTerbaru' => Konsultasi::with('hasilUtama')->latest()->limit(6)->get(),
            'topDiagnosa' => $topDiagnosa,
        ]);
    }
}
