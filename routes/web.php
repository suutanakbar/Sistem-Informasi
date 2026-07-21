<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnggotaOrmadaController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfilOrmadaController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\VolunteerController;

Route::get('/', [PublicDashboardController::class, 'index'])->name('public.home');

// Serve images from public/storage directory (real files, not symlink)
Route::get('/storage/{path}', function ($path) {
    $filePath = public_path('storage/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

Route::get('/publik/aspirasi', [PublicDashboardController::class, 'aspirasi'])->name('public.aspirasi');
Route::get('/publik/postingan', [PublicDashboardController::class, 'postingan'])->name('public.postingan');
Route::get('/publik/postingan/{postingan}', [PublicDashboardController::class, 'showPostingan'])->name('public.postingan.show');
Route::get('/publik/postingan/filter', [PublicDashboardController::class, 'filterPostingan'])->name('public.postingan.filter');
Route::get('/publik/agenda', [PublicDashboardController::class, 'agenda'])->name('public.agenda');
Route::get('/publik/agenda/{agenda}', [PublicDashboardController::class, 'showAgenda'])->name('public.agenda.show');
Route::get('/publik/agenda/calendar', [PublicDashboardController::class, 'calendarEvents'])->name('public.agenda.calendar');
Route::get('/publik/aspirasi/{aspirasi}', [PublicDashboardController::class, 'showAspirasi'])->name('public.aspirasi.show');
Route::get('/publik/ormada', [PublicDashboardController::class, 'ormada'])->name('public.ormada');
Route::get('/publik/ormada/{profilOrmada}', [PublicDashboardController::class, 'showOrmada'])->name('public.ormada.show');

// Public volunteer registration (no auth required)
Route::post('/agenda/{agenda}/daftar-volunteer', [AgendaController::class, 'daftarVolunteer'])
    ->name('agenda.daftar-volunteer');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/agenda/calendar', [AgendaController::class, 'calendarEvents'])->name('agenda.calendar');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin routes - full access
    Route::middleware('role:admin')->group(function () {
        Route::resource('admin', \App\Http\Controllers\AdminController::class);
    });

    // Profil Ormada routes - accessible by admin, pemda, and pengurus
    Route::resource('profil-ormada', ProfilOrmadaController::class)
        ->except(['destroy'])
        ->parameters(['profil-ormada' => 'profilOrmada']);

    // Anggota Ormada routes - accessible by admin and pengurus
    Route::resource('anggota-ormada', AnggotaOrmadaController::class)
        ->except(['index'])
        ->parameters(['anggota-ormada' => 'anggotaOrmada']);

    // Pemda, Admin, and Pengurus routes
    Route::middleware('role:pemda,admin,pengurus_ormada')->group(function () {
        Route::resource('agenda', AgendaController::class);
        Route::patch('/agenda/{agenda}/publish', [AgendaController::class, 'publish'])
            ->name('agenda.publish');
        Route::get('/agenda/{agenda}/volunteer', [AgendaController::class, 'listVolunteer'])
            ->name('agenda.volunteer');
        
        Route::get('/volunteer', [VolunteerController::class, 'index'])
            ->name('volunteer.index');
        Route::patch('/volunteer/{volunteer}/status', [VolunteerController::class, 'updateStatus'])
            ->name('volunteer.update-status');
        
        Route::resource('postingan', PostinganController::class);
        Route::patch('/postingan/{postingan}/publish', [PostinganController::class, 'publish'])
            ->name('postingan.publish');
        
        Route::resource('proposal', ProposalController::class);
        Route::patch('/proposal/{proposal}/status', [ProposalController::class, 'updateStatus'])
            ->name('proposal.update-status');
        
        Route::resource('aspirasi', AspirasiController::class);
        Route::patch('/aspirasi/{aspirasi}/tanggapan', [AspirasiController::class, 'updateTanggapan'])
            ->name('aspirasi.update-tanggapan');
    });

    
    Route::get('/anggota-ormada', [AnggotaOrmadaController::class, 'index'])
        ->name('anggota-ormada.index');
});
