<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class RuleController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');
        $rules = Rule::with(['kerusakan', 'gejala'])
            ->when($keyword, function ($q) use ($keyword) {
                $q->whereHas('kerusakan', fn ($sub) => $sub->where('kode_kerusakan', 'like', "%{$keyword}%")->orWhere('nama_kerusakan', 'like', "%{$keyword}%"))
                  ->orWhereHas('gejala', fn ($sub) => $sub->where('kode_gejala', 'like', "%{$keyword}%")->orWhere('nama_gejala', 'like', "%{$keyword}%"));
            })
            ->join('kerusakans', 'rules.kerusakan_id', '=', 'kerusakans.id')
            ->join('gejalas', 'rules.gejala_id', '=', 'gejalas.id')
            ->select('rules.*')
            ->orderBy('kerusakans.kode_kerusakan')
            ->orderBy('gejalas.kode_gejala')
            ->paginate(12)
            ->withQueryString();

        return view('admin.rule.index', compact('rules', 'keyword'));
    }

    public function create()
    {
        return view('admin.rule.form', [
            'rule' => new Rule(),
            'mode' => 'create',
            'gejala' => Gejala::orderBy('kode_gejala')->get(),
            'kerusakan' => Kerusakan::orderBy('kode_kerusakan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Rule::create($this->validated($request));
        return redirect()->route('admin.rule.index')->with('success', 'Rule berhasil ditambahkan.');
    }

    public function edit(Rule $rule)
    {
        return view('admin.rule.form', [
            'rule' => $rule,
            'mode' => 'edit',
            'gejala' => Gejala::orderBy('kode_gejala')->get(),
            'kerusakan' => Kerusakan::orderBy('kode_kerusakan')->get(),
        ]);
    }

    public function update(Request $request, Rule $rule)
    {
        $rule->update($this->validated($request, $rule->id));
        return redirect()->route('admin.rule.index')->with('success', 'Rule berhasil diperbarui.');
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();
        return back()->with('success', 'Rule berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'kerusakan_id' => ['required', 'exists:kerusakans,id'],
            'gejala_id' => [
                'required',
                'exists:gejalas,id',
                ValidationRule::unique('rules')->where(fn ($q) => $q
                    ->where('kerusakan_id', $request->kerusakan_id)
                    ->where('gejala_id', $request->gejala_id)
                )->ignore($ignoreId),
            ],
            'cf_pakar' => ['required', 'numeric', 'min:0', 'max:1'],
        ], [
            'gejala_id.unique' => 'Kombinasi kerusakan dan gejala ini sudah ada dalam rule.',
        ]);
    }
}
