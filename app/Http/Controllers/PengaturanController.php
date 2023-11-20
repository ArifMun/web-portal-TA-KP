<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\FormAkses;
use App\Models\Konsentrasi;
use App\Models\Pengumuman;
use Carbon\Carbon;

class PengaturanController extends Controller
{
    public function index()
    {
        $thnAkademik = TahunAkademik::all()->sortDesc();
        $konsentrasi = Konsentrasi::all()->sortDesc();
        $formAkses   = FormAkses::all()->sortDesc();
        $toggle      = FormAkses::find(1);
        $pengumuman  = Pengumuman::all();
        $dokumen     = Dokumen::all();
        // $aktifValue = $toggle->akses == 1 ? true : false;

        return \view(
            'admin.pengaturan',
            \compact(
                'thnAkademik',
                'konsentrasi',
                'formAkses',
                'pengumuman',
                'dokumen'
            )
        );
    }
}
