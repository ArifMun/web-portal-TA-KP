<?php

namespace App\Http\Controllers;

use App\Models\DaftarKP;
use App\Models\SeminarKP;
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

        $kpditerima = new DaftarKP();
        $datakp = $kpditerima->d_kp_diterima()->count();

        $s_kp        = new SeminarKP();
        $dataseminar    = $s_kp->s_Selesai();

        $thn    = TahunAkademik::get();

        // $user = Auth::user();

        return \view('dashboard.dashboard', \compact('notifAcc', 'notifWait', 'seminar', 'datakp', 'thn', 'dataseminar'));
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
