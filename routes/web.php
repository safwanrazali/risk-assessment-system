<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DaftarRisikoController as AdminDaftarRisikoController;
use App\Http\Controllers\Admin\SektorController;
use App\Http\Controllers\Admin\AgensiController;
use App\Http\Controllers\Admin\JenisAsetController;
use App\Http\Controllers\Admin\KategoriRisikoController;
use App\Http\Controllers\Admin\SubKategoriRisikoController;
use App\Http\Controllers\Admin\RisikoController;
use App\Http\Controllers\Admin\KategoriPuncaRisikoController;
use App\Http\Controllers\Admin\PuncaRisikoController;
use App\Http\Controllers\Agensi\DashboardController as AgensiDashboardController;
use App\Http\Controllers\Agensi\DaftarRisikoController as AgensiDaftarRisikoController;
use App\Http\Controllers\PenggunaController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AgensiMiddleware;
use Illuminate\Auth\Middleware\Authenticate as AuthenticateMiddleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Password change routes for first-time login
Route::middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/auth/change-password', [ChangePasswordController::class, 'show'])->name('auth.change-password');
    Route::post('/auth/change-password', [ChangePasswordController::class, 'update'])->name('auth.change-password.store');
});

Route::get('/home', function () {
    if (Auth::check()) {
        return redirect()->route(Auth::user()->peranan === 'admin' ? 'admin.dashboard' : 'agensi.dashboard');
    }
    return redirect()->route('login');
})->name('home')->middleware(AuthenticateMiddleware::class);

Route::prefix('admin')->name('admin.')->middleware([AuthenticateMiddleware::class, AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('sektor', SektorController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('agensi', AgensiController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('jenis_aset', JenisAsetController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('kategori_risiko', KategoriRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('sub_kategori_risiko', SubKategoriRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('risiko', RisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('kategori_punca_risiko', KategoriPuncaRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('punca_risiko', PuncaRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('daftar_risiko', AdminDaftarRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('laporan/risiko', [AdminDaftarRisikoController::class, 'laporan'])->name('laporan.risiko');
    Route::get('laporan/risiko/download/csv', [AdminDaftarRisikoController::class, 'downloadCsv'])->name('laporan.risiko.download-csv');
    Route::get('laporan/risiko/download/pdf', [AdminDaftarRisikoController::class, 'downloadPdf'])->name('laporan.risiko.download-pdf');
    // Table-specific downloads
    Route::get('laporan/risiko/download/agency/csv', [AdminDaftarRisikoController::class, 'downloadAgencyCsv'])->name('laporan.risiko.download-agency-csv');
    Route::get('laporan/risiko/download/agency/pdf', [AdminDaftarRisikoController::class, 'downloadAgencyPdf'])->name('laporan.risiko.download-agency-pdf');
    Route::get('laporan/risiko/download/asset/csv', [AdminDaftarRisikoController::class, 'downloadAssetCsv'])->name('laporan.risiko.download-asset-csv');
    Route::get('laporan/risiko/download/asset/pdf', [AdminDaftarRisikoController::class, 'downloadAssetPdf'])->name('laporan.risiko.download-asset-pdf');
    Route::get('laporan/risiko/download/detail/csv', [AdminDaftarRisikoController::class, 'downloadDetailCsv'])->name('laporan.risiko.download-detail-csv');
    Route::get('laporan/risiko/download/detail/pdf', [AdminDaftarRisikoController::class, 'downloadDetailPdf'])->name('laporan.risiko.download-detail-pdf');

    Route::resource('pengguna', PenggunaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

Route::prefix('agensi')->name('agensi.')->middleware([AuthenticateMiddleware::class, AgensiMiddleware::class])->group(function () {
    Route::get('/dashboard', [AgensiDashboardController::class, 'index'])->name('dashboard');
    Route::resource('daftar_risiko', AgensiDaftarRisikoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('laporan/risiko', [AgensiDaftarRisikoController::class, 'laporan'])->name('laporan.risiko');
    Route::get('laporan/risiko/download/csv', [AgensiDaftarRisikoController::class, 'downloadCsv'])->name('laporan.risiko.download-csv');
    Route::get('laporan/risiko/download/pdf', [AgensiDaftarRisikoController::class, 'downloadPdf'])->name('laporan.risiko.download-pdf');
    // Table-specific downloads
    Route::get('laporan/risiko/download/agency/csv', [AgensiDaftarRisikoController::class, 'downloadAgencyCsv'])->name('laporan.risiko.download-agency-csv');
    Route::get('laporan/risiko/download/agency/pdf', [AgensiDaftarRisikoController::class, 'downloadAgencyPdf'])->name('laporan.risiko.download-agency-pdf');
    Route::get('laporan/risiko/download/asset/csv', [AgensiDaftarRisikoController::class, 'downloadAssetCsv'])->name('laporan.risiko.download-asset-csv');
    Route::get('laporan/risiko/download/asset/pdf', [AgensiDaftarRisikoController::class, 'downloadAssetPdf'])->name('laporan.risiko.download-asset-pdf');
    Route::get('laporan/risiko/download/detail/csv', [AgensiDaftarRisikoController::class, 'downloadDetailCsv'])->name('laporan.risiko.download-detail-csv');
    Route::get('laporan/risiko/download/detail/pdf', [AgensiDaftarRisikoController::class, 'downloadDetailPdf'])->name('laporan.risiko.download-detail-pdf');
    Route::resource('pengguna', PenggunaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
