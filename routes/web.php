<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminKonsultasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/konsultasi', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/konsultasi/proses', [ConsultationController::class, 'process'])->name('consultation.process');
Route::get('/hasil/{konsultasi}', [ConsultationController::class, 'result'])->name('consultation.result');
Route::get('/hasil/{konsultasi}/cetak', [ConsultationController::class, 'print'])->name('consultation.print');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.process');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('gejala', GejalaController::class)->except(['show']);
    Route::resource('kerusakan', KerusakanController::class)->except(['show']);
    Route::resource('rule', RuleController::class)->except(['show']);
    Route::get('konsultasi', [AdminKonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::get('konsultasi/{konsultasi}', [AdminKonsultasiController::class, 'show'])->name('konsultasi.show');
    Route::delete('konsultasi/{konsultasi}', [AdminKonsultasiController::class, 'destroy'])->name('konsultasi.destroy');
    Route::get('laporan', [AdminKonsultasiController::class, 'laporan'])->name('laporan.index');
});
