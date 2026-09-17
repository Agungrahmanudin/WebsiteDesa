<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataPendudukController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\LayananSuratController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PerangkatDesaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page Website Desa)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'detailBerita'])->name('berita.detail');
Route::get('/pengumuman', [HomeController::class, 'pengumuman'])->name('pengumuman');
Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [HomeController::class, 'detailGaleri'])->name('galeri.detail');
Route::get('/layanan-surat', [HomeController::class, 'layanan'])->name('layanan');
Route::post('/layanan-surat', [HomeController::class, 'simpanPermohonan'])->name('layanan.kirim');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita & Kategori
    Route::resource('berita', BeritaController::class);
    Route::resource('kategori', KategoriBeritaController::class);

    // Pengumuman & Agenda
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('agenda', AgendaController::class);

    // Galeri
    Route::resource('galeri', GaleriController::class);

    // Layanan & Permohonan Surat
    Route::resource('layanan', LayananSuratController::class);
    Route::get('/permohonan-surat', [LayananSuratController::class, 'permohonanIndex'])->name('permohonan.index');
    Route::get('/permohonan-surat/{id}', [LayananSuratController::class, 'permohonanShow'])->name('permohonan.show');
    Route::put('/permohonan-surat/{id}', [LayananSuratController::class, 'updatePermohonan'])->name('permohonan.update');
    Route::delete('/permohonan-surat/{id}', [LayananSuratController::class, 'destroyPermohonan'])->name('permohonan.destroy');

    // Penduduk & Perangkat Desa
    Route::resource('penduduk', DataPendudukController::class);
    Route::resource('perangkat', PerangkatDesaController::class);

    // Kontak / Profil Desa
    Route::get('/kontak', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::post('/kontak', [KontakController::class, 'update'])->name('kontak.update');

    // Users
    Route::resource('users', UserController::class);
});
