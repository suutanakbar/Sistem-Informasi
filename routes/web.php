<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaOrmadaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilOrmadaController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PublicDashboardController;

Route::get('/', [PublicDashboardController::class, 'index'])->name('public.home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('profil-ormada', ProfilOrmadaController::class)
        ->except(['destroy'])
        ->parameters(['profil-ormada' => 'profilOrmada']);

    Route::resource('anggota-ormada', AnggotaOrmadaController::class)
        ->parameters(['anggota-ormada' => 'anggotaOrmada']);

    Route::resource('proposal', ProposalController::class);
    Route::patch('/proposal/{proposal}/status', [ProposalController::class, 'updateStatus'])
        ->name('proposal.update-status');
});
