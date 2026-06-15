<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');
        $kerusakans = Kerusakan::query()
            ->when($keyword, fn ($q) => $q->where('kode_kerusakan', 'like', "%{$keyword}%")
                ->orWhere('nama_kerusakan', 'like', "%{$keyword}%")
                ->orWhere('kategori', 'like', "%{$keyword}%"))
            ->orderBy('kode_kerusakan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kerusakan.index', compact('kerusakans', 'keyword'));
    }

    public function create()
    {
        return view('admin.kerusakan.form', ['kerusakan' => new Kerusakan(), 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        Kerusakan::create($this->validated($request));
        return redirect()->route('admin.kerusakan.index')->with('success', 'Data kerusakan berhasil ditambahkan.');
    }

    public function edit(Kerusakan $kerusakan)
    {
        return view('admin.kerusakan.form', compact('kerusakan') + ['mode' => 'edit']);
    }

    public function update(Request $request, Kerusakan $kerusakan)
    {
        $kerusakan->update($this->validated($request, $kerusakan->id));
        return redirect()->route('admin.kerusakan.index')->with('success', 'Data kerusakan berhasil diperbarui.');
    }

    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return back()->with('success', 'Data kerusakan berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'kode_kerusakan' => ['required', 'max:10', 'unique:kerusakans,kode_kerusakan'.($ignoreId ? ','.$ignoreId : '')],
            'nama_kerusakan' => ['required', 'max:255'],
            'kategori' => ['required', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'penyebab' => ['nullable', 'string'],
            'solusi' => ['nullable', 'string'],
        ]);
    }
}
