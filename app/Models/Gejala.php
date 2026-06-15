<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejalas';
    protected $fillable = ['kode_gejala', 'nama_gejala', 'kategori'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}
