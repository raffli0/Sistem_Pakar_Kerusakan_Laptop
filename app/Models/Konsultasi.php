<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $fillable = ['nama_pengguna', 'tanggal', 'hasil_kerusakan_id', 'nilai_cf'];
    protected $casts = ['tanggal' => 'datetime', 'nilai_cf' => 'float'];

    public function hasilUtama()
    {
        return $this->belongsTo(Kerusakan::class, 'hasil_kerusakan_id');
    }

    public function details()
    {
        return $this->hasMany(DetailKonsultasi::class);
    }

    public function hasilDiagnosa()
    {
        return $this->hasMany(DiagnosisResult::class)->orderByDesc('nilai_cf');
    }
}
