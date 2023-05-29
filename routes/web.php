<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DaftarTAController;
use App\Http\Controllers\SidangTAController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormAksesController;
use App\Http\Controllers\SeminarKPController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\BimbinganKPController;
use App\Http\Controllers\BimbinganTAController;
use App\Http\Controllers\KonsentrasiController;
use App\Http\Controllers\ThnAkademikController;
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

Route::get('login-page', [AuthController::class, 'index'])->name('login-page');
Route::post('login-process', [AuthController::class, 'login_process']);
Route::get('logout', [AuthController::class, 'logout']);

// Route::get('register-page', [UserRegistrasiController::class, 'index'])->name('register-page');
Route::get('user-registrasi', [UserRegistrasiController::class, 'create'])->name('user-registrasi');
Route::post('register-proccess', [UserRegistrasiController::class, 'store']);

// Route::middleware(['auth', 'CheckLevel:0'])->group(function () {
//     Route::resource('/dashboard', DashboardController::class);

//     // Route::get('akun', [RegistrasiController::class, 'index']);
//     Route::post('akun/daftar', [RegistrasiController::class, 'store']);
//     // Route::get('edit-akun/{id}', [RegistrasiController::class, 'edit']);
//     Route::resource('/registrasi', RegistrasiController::class);
//     // Route::get('registrasi', [RegistrasiController::class, 'index']);
//     Route::resource('/kerja-praktik', KerjaPraktikController::class);
//     // Route::get('kerja-praktik/biodata/{id}', [KerjaPraktikController::class, 'autofill']);

//     Route::resource('/seminar-kp', SeminarKPController::class);
//     Route::get('seminar-kp/mahasiswa_id/{id}', [SeminarKPController::class, 'autofill']);

//     Route::resource('/bimbingan-kp', BimbinganKPController::class);
//     Route::get('bimbingan-kp/daftarkp_id/{id}', [BimbinganKPController::class, 'autofill']);
//     // Route::get('bimbing-kp/list/{id}/', [BimbinganKPController::class, 'list_index']);

//     Route::resource('/daftar-ta', DaftarTAController::class);

//     Route::resource('/sidang-ta', SidangTAController::class);
//     Route::get('sidang-ta/daftar_ta_id/{id}', [SidangTAController::class, 'autofill']);

//     Route::resource('/bimbingan-ta', BimbinganTAController::class);
//     Route::get('bimbingan-ta/daftar_ta_id/{id}', [BimbinganTAController::class, 'autofill']);

//     Route::get('manajemen-form', [ManajemenFormController::class, 'index']);
//     Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
//     Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

//     Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
//     Route::post('konsentrasi/{id}/ubah', [KonsentrasiController::class, 'update']);
//     Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

//     Route::get('akses/update', [FormAksesController::class, 'update']);
//     Route::post('akses/tambah', [FormAksesController::class, 'store']);
//     Route::post('akses/{id}/destroy', [FormAksesController::class, 'destroy']);

//     Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
// });
Route::group(
    ['middleware' => ['auth', 'CheckLevel:0']],
    function () {
        Route::get('manajemen-form', [ManajemenFormController::class, 'index']);
        Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
        Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

        Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
        Route::post('konsentrasi/{id}/ubah', [KonsentrasiController::class, 'update']);
        Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

        Route::get('akses/update', [FormAksesController::class, 'update']);
        Route::post('akses/tambah', [FormAksesController::class, 'store']);
        Route::post('akses/{id}/destroy', [FormAksesController::class, 'destroy']);
    }
);
Route::group(['middleware' => ['auth', 'CheckLevel:1,0']], function () {

    Route::resource('/dashboard', DashboardController::class);

    // Route::get('akun', [RegistrasiController::class, 'index']);
    Route::post('akun/daftar', [RegistrasiController::class, 'store']);
    // Route::get('edit-akun/{id}', [RegistrasiController::class, 'edit']);
    Route::resource('/registrasi', RegistrasiController::class);
    // Route::get('registrasi', [RegistrasiController::class, 'index']);
    Route::resource('/kerja-praktik', KerjaPraktikController::class);
    // Route::get('kerja-praktik/biodata/{id}', [KerjaPraktikController::class, 'autofill']);

    Route::resource('/seminar-kp', SeminarKPController::class);
    Route::get('seminar-kp/mahasiswa_id/{id}', [SeminarKPController::class, 'autofill']);

    Route::resource('/bimbingan-kp', BimbinganKPController::class);
    Route::get('bimbingan-kp/daftarkp_id/{id}', [BimbinganKPController::class, 'autofill']);
    // Route::get('bimbing-kp/list/{id}/', [BimbinganKPController::class, 'list_index']);

    Route::resource('/daftar-ta', DaftarTAController::class);

    Route::resource('/sidang-ta', SidangTAController::class);
    Route::get('sidang-ta/daftar_ta_id/{id}', [SidangTAController::class, 'autofill']);

    Route::resource('/bimbingan-ta', BimbinganTAController::class);
    Route::get('bimbingan-ta/daftar_ta_id/{id}', [BimbinganTAController::class, 'autofill']);

    // Route::get('manajemen-form', [ManajemenFormController::class, 'index']);
    // Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
    // Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

    // Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
    // Route::post('konsentrasi/{id}/ubah', [KonsentrasiController::class, 'update']);
    // Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

    // Route::get('akses/update', [FormAksesController::class, 'update']);
    // Route::post('akses/tambah', [FormAksesController::class, 'store']);
    // Route::post('akses/{id}/destroy', [FormAksesController::class, 'destroy']);

    Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
});
