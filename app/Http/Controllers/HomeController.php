<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Konsultasi;
use App\Models\Rule;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'jumlahGejala' => Gejala::count(),
            'jumlahKerusakan' => Kerusakan::count(),
            'jumlahRule' => Rule::count(),
            'jumlahKonsultasi' => Konsultasi::count(),
        ]);
    }
}
