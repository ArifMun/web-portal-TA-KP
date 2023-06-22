<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserCheck
{
    public static function checkBimbinganKP()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $level = $user->level;
            return ($level == 0 && $user->biodata->mahasiswa->daftarkp[0]->bimbingankp->count() >= 12);
        }

        return false;
    }

    public static function checkBimbinganTA()
    {
        $bimbingan_1 = 0;
        $bimbingan_2 = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $level = $user->level;
            $bimbingan_1 = $user->biodata->mahasiswa->daftarta[0]->bimbinganta_1->count() >= 12;
            $bimbingan_2 = $user->biodata->mahasiswa->daftarta[0]->bimbinganta_2->count() >= 12;
            return ($level == 0 && $bimbingan_1 && $bimbingan_2 || Auth::user()->level != 0);
        }

        return false;
    }
}
