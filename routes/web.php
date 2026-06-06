<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\PelangganIndex;
use App\Livewire\TransaksiIndex;
use App\Livewire\PengeluaranIndex;
use App\Livewire\LaporanIndex;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Pelanggan
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', PelangganIndex::class)->name('index');
        Route::get('/create', \App\Livewire\PelangganForm::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\PelangganForm::class)->name('edit');
    });

    // Transaksi
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', TransaksiIndex::class)->name('index');
        Route::get('/create', \App\Livewire\TransaksiForm::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\TransaksiForm::class)->name('edit');
    });

    // Pengeluaran
    Route::prefix('pengeluaran')->name('pengeluaran.')->group(function () {
        Route::get('/', PengeluaranIndex::class)->name('index');
        Route::get('/create', \App\Livewire\PengeluaranForm::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\PengeluaranForm::class)->name('edit');
    });

    // Laporan
    Route::get('/laporan', LaporanIndex::class)->name('laporan.index');

    // Detergen / Inventory (Stok)
    Route::prefix('detergen')->name('detergen.')->group(function () {
        Route::get('/', \App\Livewire\DetergenIndex::class)->name('index');
        Route::get('/create', \App\Livewire\DetergenForm::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\DetergenForm::class)->name('edit');
        Route::get('/restock/{id?}', \App\Livewire\DetergenRestock::class)->name('restock');
    });

    // Profile
    Route::get('/profile', \App\Livewire\Profile::class)->name('profile');

    // Pengaturan
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/update', [SettingController::class, 'update'])->name('update');
        Route::get('/cabang', \App\Livewire\BranchSetting::class)->name('cabang');
    });
});
