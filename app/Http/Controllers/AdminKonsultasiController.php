<?php

namespace App\Http\Controllers;

use App\Models\DiagnosisResult;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminKonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Konsultasi::with('hasilUtama')->latest();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where('nama_pengguna', 'like', "%{$keyword}%");
        }

        $konsultasis = $query->paginate(10)->withQueryString();

        return view('admin.konsultasi.index', compact('konsultasis'));
    }

    public function show(Konsultasi $konsultasi)
    {
        $konsultasi->load(['hasilUtama', 'details.gejala', 'hasilDiagnosa.kerusakan']);
        return view('admin.konsultasi.show', compact('konsultasi'));
    }

    public function destroy(Konsultasi $konsultasi)
    {
        $konsultasi->delete();
        return redirect()->route('admin.konsultasi.index')->with('success', 'Riwayat konsultasi berhasil dihapus.');
    }

    public function laporan(Request $request)
    {
        $query = Konsultasi::with('hasilUtama')->latest();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        $konsultasis = $query->get();

        $topDiagnosa = DiagnosisResult::select('kerusakan_id', DB::raw('COUNT(*) as total'), DB::raw('AVG(nilai_cf) as rata_cf'))
            ->with('kerusakan')
            ->groupBy('kerusakan_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.laporan.index', compact('konsultasis', 'topDiagnosa'));
    }
}
