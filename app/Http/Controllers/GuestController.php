<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Dokumen;
use App\Models\DaftarKP;
use App\Models\DaftarTA;
use App\Models\SidangTA;
use App\Models\SeminarKP;
use App\Models\Pengumuman;
use App\Models\TahunAkademik;

class GuestController extends Controller
{
    public static function index()
    {
        $notifAcc = DaftarKP::all()->count();
        $notifWait = DaftarKP::where('stts_pengajuan', '=', 'tertunda')
            ->count();
        $seminar   = SeminarKP::get()->where('stts_seminar', '=', 'selesai')->count();
        $sidangTa  = new SidangTA();
        $sidang    = $sidangTa->s_selesai();

        $daftarTa  = new DaftarTA();
        $TAditerima = $daftarTa->d_diterima()->count();
        $kpditerima = new DaftarKP();
        $datakp = $kpditerima->d_kp_diterima()->count();

        $s_kp        = new SeminarKP();
        $dataseminar    = $s_kp->s_Selesai();

        $seminarkp        = new SeminarKP();

        $tahuns = TahunAkademik::all();
        $tahunAkademik = [];
        $dataSeminarKP = [];
        $dataDaftarKP = [];
        $dataDaftarTA = [];
        $dataSidangTA = [];

        $dokumen = Dokumen::get()->first();
        // $panduan = $dokumen->

        foreach ($tahuns as $tahun) {
            $tahunAkademik[] = $tahun->tahun;
            $dataSeminarKP[] = $tahun->seminarkp()
                ->where('thn_akademik_id', $tahun->id)
                ->where('stts_seminar', 'selesai')
                ->count();
            $dataDaftarKP[]  = $tahun->daftarkp()
                ->where('thn_akademik_id', $tahun->id)
                ->where('stts_pengajuan', 'diterima')
                ->count();
            $dataDaftarTA[]  = $tahun->daftarta()
                ->where('thn_akademik_id', $tahun->id)
                ->where('stts_pengajuan', 'diterima')
                ->count();
            $dataSidangTA[] = $tahun->sidangta()
                ->where('thn_akademik_id', $tahun->id)
                ->where('stts_sidang', 'selesai')
                ->count();
        }
        $pengumuman   = Pengumuman::get()->first();

        return \view('guest.home', \compact(
            'notifAcc',
            'notifWait',
            'seminar',
            'datakp',
            'tahunAkademik',
            'dataseminar',
            'sidang',
            'TAditerima',
            'dataSeminarKP',
            'dataDaftarKP',
            'dataDaftarTA',
            'dataSidangTA',
            'pengumuman',
            'dokumen'

        ));
    }
    public static function login()
    {
        return \view('login');
    }

    public function daftar_pembimbing_kp()
    {
        $daftar_kp   = new DaftarKP();
        $thn         = new TahunAkademik();

        $list_acc_kp = $daftar_kp->where('stts_pengajuan', '=', 'diterima')->get()->sortByDesc('id');
        $dosen       = Dosen::with('biodata')->get();
        $thn_akademik = $thn->latest('id')->limit(5)->get();
        $pengumuman   = Pengumuman::get()->first();

        return \view('guest.daftar-pembimbing-kp', \compact(
            'list_acc_kp',
            'dosen',
            'thn_akademik',
            'pengumuman'
        ));
    }

    public function jadwal_seminar_kp()
    {
        $seminar_kp  = new SeminarKP();
        $seminarkp   = $seminar_kp->get()->sortByDesc('id');
        $thn         = new TahunAkademik();
        $thn_akademik = $thn->latest('id')->limit(5)->get();

        $dosen       = Dosen::with('biodata')->get();
        $pengumuman   = Pengumuman::get()->first();

        return \view('guest.jadwal-seminar-kp', \compact(
            'seminarkp',
            'dosen',
            'thn_akademik',
            'pengumuman'
        ));
    }

    public function daftar_pembimbing_ta()
    {
        $daftar_ta   = new DaftarTA();
        $list_acc_ta = $daftar_ta->where('stts_pengajuan', '=', 'diterima')->get()->sortByDesc('id');

        $thn         = new TahunAkademik();
        $thn_akademik = $thn->latest('id')->limit(5)->get();

        $dosen       = Dosen::with('biodata')->get();
        $pengumuman   = Pengumuman::get()->first();

        return \view('guest.daftar-pembimbing-ta', \compact(
            'list_acc_ta',
            'dosen',
            'thn_akademik',
            'pengumuman'
        ));
    }

    public function jadwal_sidang()
    {
        $jadwalSidang = SidangTA::with('thnakademik', 'daftarta')->where('stts_sidang', '!=', 'proses')->latest()->get();
        $dosen        = Dosen::all();
        $pengumuman   = Pengumuman::get()->first();
        return \view('guest.jadwal-sidang', \compact('jadwalSidang', 'dosen', 'pengumuman'));
    }
}
