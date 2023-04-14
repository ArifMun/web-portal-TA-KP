<?php

use App\Models\SeminarKP;
// use App\Models\RegistrasiController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MhsKPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormAksesController;
use App\Http\Controllers\SeminarKPController;
use App\Http\Controllers\RegistrasiController;
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

// Route::get('/', function () {
//     return view('forms.login');
// });
Route::get('login-page', [AuthController::class, 'index'])->name('login-page');
Route::post('login-process', [AuthController::class, 'login_process']);
Route::get('logout', [AuthController::class, 'logout']);

// Route::get('register-page', [UserRegistrasiController::class, 'index'])->name('register-page');
Route::get('user-registrasi', [UserRegistrasiController::class, 'create'])->name('user-registrasi');
Route::post('register-proccess', [UserRegistrasiController::class, 'store']);

Route::group(['middleware' => ['auth', 'CheckLevel:0,1,2']], function () {

    Route::resource('/dashboard', DashboardController::class);

    // Route::get('akun', [RegistrasiController::class, 'index']);
    Route::post('akun/daftar', [RegistrasiController::class, 'store']);
    // Route::get('edit-akun/{id}', [RegistrasiController::class, 'edit']);
    Route::resource('/registrasi', RegistrasiController::class);
    // Route::get('registrasi', [RegistrasiController::class, 'index']);
    Route::resource('/kerja-praktik', KerjaPraktikController::class);
    Route::get('kerja-praktik/biodata/{id}', [KerjaPraktikController::class, 'autofill']);

    Route::resource('/seminar-kp', SeminarKPController::class);
    Route::get('seminar-kp/biodata/{id}', [SeminarKPController::class, 'autofill']);

    // Route::resource('/mhs-kp', MhsKPController::class);
    // Route::get('mhs-kp/biodata/{id}', [MhsKPController::class, 'autofill']);

    Route::get('manajemen-form', [ManajemenFormController::class, 'index']);
    Route::post('tahun/tambah', [ThnAkademikController::class, 'store']);
    Route::post('tahun/{id}/destroy', [ThnAkademikController::class, 'destroy']);

    Route::post('konsentrasi/tambah', [KonsentrasiController::class, 'store']);
    Route::post('konsentrasi/{id}/destroy', [KonsentrasiController::class, 'destroy']);

    Route::post('akses/{id}/update', [FormAksesController::class, 'update']);
});
