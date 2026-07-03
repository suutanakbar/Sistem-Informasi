<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaOrmadaController;
use App\Http\Controllers\ProfilOrmadaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('profil-ormada', ProfilOrmadaController::class)
        ->except(['destroy'])
        ->parameters(['profil-ormada' => 'profilOrmada']);

    Route::resource('anggota-ormada', AnggotaOrmadaController::class)
        ->parameters(['anggota-ormada' => 'anggotaOrmada']);
});
