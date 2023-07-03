<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\SidangTA;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public static function index()
    {
        $jadwalSidang = SidangTA::with('thnakademik', 'daftarta')->where('stts_sidang', '!=', 'proses')->latest()->get();
        $dosen        = Dosen::all();
        return \view('guest.jadwal-sidang', \compact('jadwalSidang', 'dosen'));
    }
    public static function login()
    {
        return \view('login');
    }
}
