<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TitikRawanController;
use App\Http\Controllers\UserController;
use App\Models\TitikRawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'dashboard' : 'login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'titikRawanPoints' => TitikRawan::mapPoints(),
            'totalTitik' => TitikRawan::count(),
            'totalKota' => TitikRawan::whereNotNull('kota_kabupaten')->distinct('kota_kabupaten')->count('kota_kabupaten'),
            'aksesTerbuka' => TitikRawan::where('akses', 'Terbuka')->count(),
            'aksesTertutup' => TitikRawan::where('akses', 'Tertutup')->count(),
        ]);
    })->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::resource('titik-rawan', TitikRawanController::class);
    Route::get('/titik-rawan/{titik_rawan}/foto', [TitikRawanController::class, 'foto'])->name('titik-rawan.foto');
    Route::resource('users', UserController::class)->except('show');
});
