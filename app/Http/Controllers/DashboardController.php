<?php

namespace App\Http\Controllers;

use App\Models\DaftarKP;
use App\Models\DaftarTA;
use App\Models\SeminarKP;
use App\Models\SidangTA;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        return \view('dashboard.dashboard', \compact(
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
            'dataSidangTA'

        ));
        // return \view('layouts.layout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
