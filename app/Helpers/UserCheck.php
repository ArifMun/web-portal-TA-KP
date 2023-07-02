<?php

namespace App\Helpers;

use App\Models\DaftarKP;
use App\Models\DaftarTA;
use App\Models\Mahasiswa;
use App\Models\SeminarKP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserCheck
{

    // lv 0 = mahasiswa | lv 1 = dosen | lv 2 = TU dan kaprodi
    public static function userExceptDosen()
    {
        $mhs    = Auth::user()->level == 0;
        $KaprodiTU = Auth::user()->level == 2;

        return ($mhs || $KaprodiTU);
    }

    public static function checkDaftarKP()
    {
        return (Auth::user()->biodata->mahasiswa->daftarkp->count() == 0);
    }

    // cek user lv ==0 && jika pendaftar kp sudah diterima maka dapat bimbingan
    // untuk lv 1/ dosen selalu ada menu bimbingan
    public static function authBimbinganKP()
    {
        $user    = Auth::user();
        $level   = $user->level;

        $checkKP = DaftarKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) { //cek apakah pendaftar KP sudah diterima
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->where('stts_pengajuan', '=', 'diterima')->sortByDesc('id')->count();

        return ($user->level == 0 && $checkKP != 0  || $user->level == 1);
    }

    public static function checkBimbinganKP()
    {

        $user           = Auth::user();
        $level          = $user->level;
        // $countBimbingan = $user->biodata->mahasiswa->daftarkp[0]->bimbingankp->count() >= 5;
        $daftarkpIds = DaftarKP::pluck('id'); //untuk mengambil nilai tunggal dari id
        $countBimbingan =
            $user->biodata->mahasiswa->daftarkp()
            ->whereIn('id', $daftarkpIds)
            ->with('bimbingankp')
            ->get()
            ->flatMap(function ($daftarkp) { //flatMap() untuk menggabungkan semua bimbingankp dari setiap daftarkp menjadi satu koleksi.
                return $daftarkp->bimbingankp;
            })
            ->where('stts', '!=', 'proses')
            ->count() >= 2;

        return ($level == 0 && $countBimbingan);
    }


    public static function checkSeminarKP()
    {

        $user    = Auth::user();
        $level   = $user->level;

        $checkSttsSeminar = SeminarKP::with('daftarkp')->whereHas('daftarkp', function ($q) { //cek apakah seminar sudah selesai
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->where('stts_seminar', '=', 'selesai')->sortByDesc('id')->count();


        return ($checkSttsSeminar != 0 || $level == 2);
    }

    public static function checkDaftarTA()
    {
        return (Auth::user()->biodata->mahasiswa->daftarta->count() == 0);
    }

    public static function authBimbinganTA()
    {
        $user    = Auth::user();
        $level   = $user->level;

        $checkKP = DaftarTA::with('mahasiswa')->whereHas('mahasiswa', function ($q) { //cek apakah pendaftar TA sudah diterima
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->where('stts_pengajuan', '=', 'diterima')->sortByDesc('id')->count();

        return ($user->level == 0 && $checkKP != 0  || $user->level == 1);
    }

    public static function checkBimbinganTA()
    {

        $daftarTAId = DaftarTA::pluck('id');
        $countBimbingan_1 = Auth::user()->biodata
            ->mahasiswa->daftarta()
            ->whereIn('id', $daftarTAId)
            ->with('bimbinganta_1')
            ->get()
            ->flatMap(function ($daftarta) {
                return $daftarta->bimbinganta_1;
            })
            ->where('stts', '!=', 'proses')
            ->count() >= 2;

        $countBimbingan_2 = Auth::user()->biodata
            ->mahasiswa->daftarta()
            ->whereIn('id', $daftarTAId)
            ->with('bimbinganta_2')
            ->get()
            ->flatMap(function ($daftarta) {
                return $daftarta->bimbinganta_2;
            })
            ->where('stts', '!=', 'proses')
            ->count() >= 2;

        return (Auth::user()->level == 0 && $countBimbingan_1 && $countBimbingan_2);
    }
}
