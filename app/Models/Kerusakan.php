<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $table = 'kerusakans';
    protected $fillable = ['kode_kerusakan', 'nama_kerusakan', 'kategori', 'deskripsi', 'penyebab', 'solusi'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function diagnosisResults()
    {
        return $this->hasMany(DiagnosisResult::class);
    }
}
