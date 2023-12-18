<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DataKPController;
use App\Http\Controllers\DataTAController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\DaftarTAController;
use App\Http\Controllers\SidangTAController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormAksesController;
use App\Http\Controllers\SeminarKPController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\BimbinganKPController;
use App\Http\Controllers\BimbinganTAController;
use App\Http\Controllers\KonsentrasiController;
use App\Http\Controllers\ThnAkademikController;
use App\Http\Controllers\BimbinganTA1Controller;
use App\Http\Controllers\KerjaPraktikController;
use App\Http\Controllers\ManajemenFormController;
use App\Http\Controllers\UserRegistrasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login-page');
Route::post('login-process', [AuthController::class, 'login_process']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/', [GuestController::class, 'index']);
Route::get('/kerja-praktik/dosen-pembimbing', [GuestController::class, 'daftar_pembimbing_kp']);
Route::get('/kerja-praktik/jadwal-seminar', [GuestController::class, 'jadwal_seminar_kp']);
// Route::get('/home/login', [GuestController::class, 'login']);
Route::get('/tugas-akhir/dosen-pembimbing', [GuestController::class, 'daftar_pembimbing_ta']);
Route::get('/tugas-akhir/jadwal-sidang', [GuestController::class, 'jadwal_sidang']);

// Route::get('register-page', [UserRegistrasiController::class, 'index'])->name('register-page');
Route::get('user-registrasi', [UserRegistrasiController::class, 'create'])->name('user-registrasi');
Route::post('register-proccess', [UserRegistrasiController::class, 'store']);

Route::group(['middleware' => ['auth', 'CheckLevel:0,1,2,3']], function () {

    Route::resource('/dashboard', DashboardController::class);


    Route::resource('/kerja-praktik', KerjaPraktikController::class)->middleware('CheckLevel:0,2');
    Route::put('update-status-kp/{id}', [KerjaPraktikController::class, 'updateStatus']);

    Route::resource('/seminar-kp', SeminarKPController::class)->middleware('CheckLevel:0,2');
    Route::put('update-status-seminar/{id}', [SeminarKPController::class, 'updateStatus']);
    Route::get('seminar-kp/mahasiswa_id/{id}', [SeminarKPController::class, 'autofill']);
    Route::get('seminar-kp/cetak-form/{id}', [SeminarKPController::class, 'printFormSeminar']);

    Route::resource('/bimbingan-kp', BimbinganKPController::class)->middleware('CheckLevel:0,1');
    Route::get('bimbingan-kp/daftarkp_id/{id}', [BimbinganKPController::class, 'autofill']);
    Route::put('update-status-bimbingan/{id}', [BimbinganKPController::class, 'updateStatus']);
    Route::get('cetak-form/bimbingan-kp', [BimbinganKPController::class, 'print']);

    Route::resource('/daftar-ta', DaftarTAController::class)->middleware('CheckLevel:0,2');
    Route::put('update-status-ta/{id}', [DaftarTAController::class, 'updateStatus']);

    Route::resource('/sidang-ta', SidangTAController::class)->middleware('CheckLevel:0,2');
    Route::get('sidang-ta/daftar_ta_id/{id}', [SidangTAController::class, 'autofill']);
    Route::put('update-status-sidang/{id}', [SidangTAController::class, 'updateStatus'])->name('update-status');
    Route::get('sidang-ta/cetak-form/{id}', [SidangTAController::class, 'printFormSidang']);

    Route::resource('/bimbingan-ta', BimbinganTAController::class)->middleware('CheckLevel:0,1');
    Route::put('update-status-bimbingan-ta/{id}', [BimbinganTAController::class, 'updateStatus']);

    Route::resource('/bimbingan-ta-1', BimbinganTA1Controller::class)->middleware('CheckLevel:0,1');
    Route::put('update-status-bimbingan-ta-1/{id}', [BimbinganTA1Controller::class, 'updateStatus']);
    Route::get('bimbingan-ta/daftar_ta_id/{id}', [BimbinganTAController::class, 'autofill']);
    Route::get('cetak-form/bimbingan-ta-1', [BimbinganTAController::class, 'print']);
    Route::get('cetak-form/bimbingan-ta-2', [BimbinganTA1Controller::class, 'print']);

    Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
    Route::get('data-kp', [DataKPController::class, 'index'])->name('data-kp');
    Route::get('data-ta', [DataTAController::class, 'index'])->name('data-ta');

    // ADMINISTRATOR
    Route::resource('/registrasi', RegistrasiController::class)->middleware('CheckLevel:2,1,0');
    Route::get('pengaturan', [PengaturanController::class, 'index'])->middleware('CheckLevel:2');
    Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
    Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

    Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
    Route::post('konsentrasi/{id}/ubah', [KonsentrasiController::class, 'update']);
    Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

    Route::post('pengumuman/tambah', [PengumumanController::class, 'store']);
    Route::post('pengumuman/{id}/update', [PengumumanController::class, 'update']);
    Route::post('pengumuman/{id}/destroy', [PengumumanController::class, 'destroy']);

    Route::post('dokumen/tambah', [DokumenController::class, 'store']);
    Route::post('dokumen/{id}/update', [DokumenController::class, 'update']);
    Route::post('dokumen/{id}/destroy', [DokumenController::class, 'destroy']);

    Route::get('akses/update', [FormAksesController::class, 'update']);
    Route::post('akses/tambah', [FormAksesController::class, 'store']);
    Route::POST('/toggle/update/kp', [FormAksesController::class, 'update_kp'])->name('toggle.update-kp');
    Route::POST('/toggle/update/ta', [FormAksesController::class, 'update_ta'])->name('toggle.update-ta');
    Route::post('akses/{id}/destroy', [FormAksesController::class, 'destroy']);
});
Route::post('/import-excel', [ImportController::class, 'import']);
Route::get('/onevaliantea', [ImportController::class, 'index']);
// Route::middleware('auth', 'CheckLevel:0,2')->group(function () {
//     Route::resource('/dashboard', DashboardController::class);
//     Route::resource('/kerja-praktik', KerjaPraktikController::class);
//     Route::resource('/seminar-kp', SeminarKPController::class);
//     Route::get('seminar-kp/mahasiswa_id/{id}', [SeminarKPController::class, 'autofill']);
// });

// Route::middleware('auth', 'CheckLevel:0,1')->group(function () {
//     Route::resource('/dashboard', DashboardController::class);
//     Route::resource('/bimbingan-kp', BimbinganKPController::class);
//     Route::get('bimbingan-kp/daftarkp_id/{id}', [BimbinganKPController::class, 'autofill']);

//     Route::resource('/bimbingan-ta', BimbinganTAController::class);
//     Route::resource('/bimbingan-ta-1', BimbinganTA1Controller::class);
//     Route::get('bimbingan-ta/daftar_ta_id/{id}', [BimbinganTAController::class, 'autofill']);
// });

// Route::middleware('auth', 'CheckLevel:0,2')->group(function () {
//     Route::resource('/daftar-ta', DaftarTAController::class);
//     Route::resource('/sidang-ta', SidangTAController::class);
//     Route::get('sidang-ta/daftar_ta_id/{id}', [SidangTAController::class, 'autofill']);
// });

// Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
// Route::get('data-kp', [DataKPController::class, 'index'])->name('data-kp');
// Route::get('data-ta', [DataTAController::class, 'index'])->name('data-ta');

// Route::middleware('auth', 'CheckLevel:2')->group(function () {
//     Route::resource('/registrasi', RegistrasiController::class);
//     Route::get('manajemen-form', [ManajemenFormController::class, 'index']);
//     Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
//     Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

//     Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
//     Route::post('konsentrasi/{id}/ubah', [KonsentrasiController::class, 'update']);
//     Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

//     Route::post('pengumuman/tambah', [PengumumanController::class, 'store']);
//     Route::post('pengumuman/{id}/update', [PengumumanController::class, 'update']);
//     Route::post('pengumuman/{id}/destroy', [PengumumanController::class, 'destroy']);

//     Route::get('akses/update', [FormAksesController::class, 'update']);
//     Route::post('akses/tambah', [FormAksesController::class, 'store']);
//     Route::post('/toggle/update/kp', [FormAksesController::class, 'update_kp'])->name('toggle.update-kp');
//     Route::post('/toggle/update/ta', [FormAksesController::class, 'update_ta'])->name('toggle.update-ta');
//     Route::post('akses/{id}/destroy', [FormAksesController::class, 'destroy']);
// });