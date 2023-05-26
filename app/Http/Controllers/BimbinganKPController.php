<?php

namespace App\Http\Controllers;

use App\Models\DaftarKP;
use App\Models\SeminarKP;
use App\Models\BimbinganKP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BimbinganKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $daftarkp    = DaftarKP::all();
        $filterStts  = BimbinganKP::distinct()->select('stts')->get();
        $thnakademik = TahunAkademik::all();
        $bimbingkp   = BimbinganKP::all();

        $sttsDosen   = BimbinganKP::with('dosen')->whereHas('dosen', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('id', '=', Auth::user()->biodata->dosen->id)
                    ->where('stts', '=', 'proses');
            }
        })->get()->count();
        $sttsMhs   = BimbinganKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id)
                    ->where('stts', '=', 'proses');
            }
        })->get()->count();

        $mhskps      = DaftarKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get()->sortByDesc('id');

        $mhskpd   = DaftarKP::with('dosen')->whereHas('dosen', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('id', '=', Auth::user()->biodata->dosen->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get()->sortByDesc('id');

        $bimbingMhs   = BimbinganKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get();

        $bimbingDosen   = BimbinganKP::with('dosen')->whereHas('dosen', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('id', '=', Auth::user()->biodata->dosen->id);
            }
        })->get();

        $list = BimbinganKP::select('daftarkp_id')->groupBy('daftarkp_id')->get();

        return \view('kerja-praktik.bimbingan-kp', \compact(
            'thnakademik',
            'daftarkp',
            'bimbingMhs',
            'bimbingDosen',
            'mhskps',
            'bimbingkp',
            'list',
            'mhskpd',
            'filterStts',
            'sttsDosen',
            'sttsMhs',
        ));
    }

    // public function list_index()
    // {

    //     $daftarkp = DaftarKP::all();
    //     // $mhskp = Auth::user()->biodata->mahasiswa;
    //     $bimbingkp = BimbinganKP::all();

    //     $mhskps   = DaftarKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
    //         if (Auth::user()->level == 0) {
    //             $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
    //         } else {
    //             $q->where('id', '=', Auth::user());
    //         }
    //     })->get()->sortByDesc('id');

    //     $bimbingMhs   = BimbinganKP::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
    //         if (Auth::user()->level == 0) {
    //             $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
    //         }
    //     })->get()->sortByDesc('id');

    //     $bimbingDosen   = BimbinganKP::with('dosen')->whereHas('dosen', function ($q) {
    //         if (Auth::user()->level == 1) {
    //             $q->where('id', '=', Auth::user()->biodata->dosen->id);
    //         }
    //     })->get()->sortByDesc('id');

    //     $list = BimbinganKP::select('daftarkp_id')->groupBy('daftarkp_id')->get();

    //     return \view('kerja-praktik.bimbingan-kp', \compact('daftarkp', 'bimbingMhs', 'bimbingDosen', 'mhskps', 'bimbingkp', 'list'));
    // }



    public function autofill($id)
    {
        $data = DaftarKP::find($id);
        return \response()->json($data);
    }

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
        $validation = Validator::make(
            $request->all(),
            [
                'judul_bimbingan'   => 'required',
                'author'            => 'required',
                'stts'              => 'required',
                'laporan_kp'        => 'required',
                // 'catatan'           => 'required',
            ]
        );

        if ($validation->fails()) {
            return \redirect('bimbingan-kp')->with('warning', 'Data Tidak Tersimpan!');
        } else {

            BimbinganKP::create([
                'daftarkp_id'       => $request->daftarkp_id,
                'dosen_id'          => $request->dosen_id,
                'mahasiswa_id'      => $request->mahasiswa_id,
                'judul_bimbingan'   => $request->judul_bimbingan,
                'catatan'           => $request->catatan,
                'stts'              => $request->stts,
                'author'            => $request->author,
                'laporan_kp'        => $request->file('laporan_kp')->store('dokumen-kp')
            ]);

            return \redirect('bimbingan-kp')->with('success', 'Data Berhasil Disimpan!');
        }
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
        $validation = Validator::make(
            $request->all(),
            [
                'judul_bimbingan'   => 'required',
                'author'            => 'required',
                'stts'              => 'required',
                // 'laporan_kp'        => 'required',
                // 'catatan'           => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-kp')->with('warning', 'Data Gagal Diperbarui');
        } else {
            $bimbingankp = BimbinganKP::findOrFail($id);
            if ($request->file('laporan_kp')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $bimbingankp->laporan_kp = $request->file('laporan_kp')->store('dokumen-kp');
            }

            $bimbingankp->daftarkp_id     = $request->daftarkp_id;
            $bimbingankp->mahasiswa_id    = $request->mahasiswa_id;
            $bimbingankp->dosen_id        = $request->dosen_id;
            $bimbingankp->judul_bimbingan = $request->judul_bimbingan;
            $bimbingankp->author          = $request->author;
            $bimbingankp->stts            = $request->stts;
            $bimbingankp->catatan            = $request->catatan;
            // $bimbingankp->laporan_kp      = $request->laporan_kp;
            $bimbingankp->update();

            return \redirect('bimbingan-kp')->with('success', 'Data Berhasil Diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bimbingankp = BimbinganKP::find($id);
        if ($bimbingankp->laporan_kp) {
            Storage::delete($bimbingankp->laporan_kp);
        }
        $bimbingankp->delete();

        return \redirect('bimbingan-kp')->with('success', 'Data Berhasil Dihapus!');
    }
}
