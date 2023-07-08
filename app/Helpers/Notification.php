<?php

namespace App\Helpers;

use App\Models\DaftarKP;
use App\Models\DaftarTA;
use App\Models\SidangTA;
use App\Models\Mahasiswa;
use App\Models\SeminarKP;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Notification
{
    public static function CountKP()
    {
        $DaftarKP = DaftarKP::with('mahasiswa', 'dosen', 'mahasiswa')
            ->where('stts_pengajuan', '=', 'tertunda')
            ->count();

        return $DaftarKP;
    }

    public static function CountSeminar()
    {
        $SeminarKP = SeminarKP::with('daftarkp', 'thnakademik')
            ->where('stts_seminar', '=', 'proses')
            ->count();

        return $SeminarKP;
    }

    public static function CountMenu()
    {
        $totalCount = self::CountKP() + self::CountSeminar();
        return $totalCount;
    }

    public static function CountTA()
    {
        $DaftarTA = DaftarTA::with('mahasiswa', 'thnakademik', 'dosen1', 'dosen2')
            ->where('stts_pengajuan', '=', 'tertunda')
            ->count();

        return $DaftarTA;
    }

    public static function CountSidang()
    {
        $SidangTA = SidangTA::with('daftarta', 'thnakademik')
            ->where('stts_sidang', '=', 'proses')
            ->count();

        return $SidangTA;
    }

    public static function CountMenuTA()
    {
        $totalCount = self::CountTA() + self::CountSidang();
        return $totalCount;
    }
}
