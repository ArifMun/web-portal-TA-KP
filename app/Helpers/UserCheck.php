<?php

namespace App\Helpers;

use App\Models\DaftarKP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserCheck
{
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
            ->count() >= 6;

        return ($level == 0 && $countBimbingan);
    }

    public static function checkDaftarKP()
    {
        return (Auth::user()->biodata->mahasiswa->daftarkp->count() == 0);
    }

    public static function authBimbingan()
    {
        $user    = Auth::user();
        $level   = $user->level;

        $checkKP = DaftarKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) { //cek apakah pendaftar KP sudah diterima
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->where('stts_pengajuan', '=', 'diterima')->sortByDesc('id')->count();

        return ($user->level == 0 && $checkKP != 0  || $user->level == 2);
    }

    public static function checkBimbinganTA()
    {
        $bimbingan_1 = 0;
        $bimbingan_2 = 0;

        $user = Auth::user();
        $level = $user->level;
        $bimbingan_1 = $user->biodata->mahasiswa->daftarta[0]->bimbinganta_1->count() >= 12;
        $bimbingan_2 = $user->biodata->mahasiswa->daftarta[0]->bimbinganta_2->count() >= 12;
        return ($level == 0 && $bimbingan_1 && $bimbingan_2 || Auth::user()->level != 0);
    }
}
