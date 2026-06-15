<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');
        $gejalas = Gejala::query()
            ->when($keyword, fn ($q) => $q->where('kode_gejala', 'like', "%{$keyword}%")
                ->orWhere('nama_gejala', 'like', "%{$keyword}%")
                ->orWhere('kategori', 'like', "%{$keyword}%"))
            ->orderBy('kode_gejala')
            ->paginate(10)
            ->withQueryString();

        return view('admin.gejala.index', compact('gejalas', 'keyword'));
    }

    public function create()
    {
        return view('admin.gejala.form', ['gejala' => new Gejala(), 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        Gejala::create($this->validated($request));
        return redirect()->route('admin.gejala.index')->with('success', 'Data gejala berhasil ditambahkan.');
    }

    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.form', compact('gejala') + ['mode' => 'edit']);
    }

    public function update(Request $request, Gejala $gejala)
    {
        $gejala->update($this->validated($request, $gejala->id));
        return redirect()->route('admin.gejala.index')->with('success', 'Data gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return back()->with('success', 'Data gejala berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'kode_gejala' => ['required', 'max:10', 'unique:gejalas,kode_gejala'.($ignoreId ? ','.$ignoreId : '')],
            'nama_gejala' => ['required', 'max:255'],
            'kategori' => ['required', 'max:100'],
        ]);
    }
}
