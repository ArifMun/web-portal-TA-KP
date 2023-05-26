<?php

namespace App\Http\Controllers;

use App\Models\DaftarTA;
use App\Models\BimbinganTA1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BimbinganTAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d_ta        = new DaftarTA();
        $l_ta        = $d_ta->all();
        $m_bimbing_1 = $d_ta->m_bimbing_1();
        $d_bimbing_1 = $d_ta->d_bimbing_1();

        $bimbing_1   = new BimbinganTA1();
        $l_bimbing_1 = $bimbing_1->all();
        // $b_dosen_1   = $bimbing_1->b_dosen_1();
        $b_dosen_1   = BimbinganTA1::with('dosen1')->whereHas('dosen1', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('id', '=', Auth::user()->biodata->dosen->id);
            }
        })->get();

        return \view('tugas-akhir.bimbingan-ta', \compact(
            'l_bimbing_1',
            'm_bimbing_1',
            'd_bimbing_1',
            'l_ta',
            'b_dosen_1'
        ));
    }

    public function autofill($id)
    {
        $data = DaftarTA::find($id);
        return \response()->json($data);
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
        $validation = Validator::make(
            $request->all(),
            [
                'daftar_ta_id' => 'required',
                'dosen_id'     => 'required',
                'mahasiswa_id' => 'required',
                'judul_bimbingan' => 'required',
                'laporan_ta'   => 'required|file|image|max:1024',
                'stts'         => 'required',
                // 'catatan'      => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-ta')->with('warning', 'Data Tidak Tersimpan!');
        } else {

            BimbinganTA1::create([
                'daftar_ta_id'      => $request->daftar_ta_id,
                'dosen_id'          => $request->dosen_id,
                'mahasiswa_id'      => $request->mahasiswa_id,
                'judul_bimbingan'   => $request->judul_bimbingan,
                'laporan_ta'        => $request->file('laporan_ta')->store('dokumen-ta'),
                'stts'              => $request->stts,
                'catatan'           => $request->catatan
            ]);

            return \redirect('bimbingan-ta')->with('success', 'Data Berhasil Disimpan!');
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
