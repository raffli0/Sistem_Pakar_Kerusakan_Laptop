<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisResult extends Model
{
    protected $table = 'hasil_diagnosas';
    protected $fillable = ['konsultasi_id', 'kerusakan_id', 'nilai_cf', 'gejala_cocok_json'];
    protected $casts = [
        'nilai_cf' => 'float',
        'gejala_cocok_json' => 'array',
    ];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class);
    }
}
