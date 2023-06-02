<?php

namespace App\Http\Controllers;

use App\Models\DaftarTA;
use App\Models\BimbinganTA2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BimbinganTA1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function autofill($id)
    {
        $data = DaftarTA::find($id);
        return \response()->json($data);
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
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-ta')->with('warning', 'Data Tidak Tersimpan!');
        } else {

            BimbinganTA2::create([
                'daftar_ta_id'      => $request->daftar_ta_id,
                'dosen_id'          => $request->dosen_id,
                'mahasiswa_id'      => $request->mahasiswa_id,
                'judul_bimbingan'   => $request->judul_bimbingan,
                'laporan_ta'        => $request->file('laporan_ta')->store('dokumen-ta'),
                'stts'              => $request->stts,
                'catatan'           => $request->catatan,
                'author'            => $request->author,
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
        $validation = Validator::make(
            $request->all(),
            [
                'judul_bimbingan' => 'required',
                'author'          => 'required',
                'stts'            => 'required',
                'laporan_ta'      => 'file|max:1024'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-ta')->with('warning', 'Data Gagal Diperbarui');
        } else {
            $bimbingan_ta_1 = BimbinganTA2::findOrFail($id);
            if ($request->file('laporan_ta')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $bimbingan_ta_1->laporan_ta = $request->file('laporan_ta')->store('dokumen_ta');
            }

            $bimbingan_ta_1->daftar_ta_id       = $request->daftar_ta_id;
            $bimbingan_ta_1->dosen_id           = $request->dosen_id;
            $bimbingan_ta_1->mahasiswa_id       = $request->mahasiswa_id;
            $bimbingan_ta_1->judul_bimbingan    = $request->judul_bimbingan;
            $bimbingan_ta_1->author             = $request->author;
            $bimbingan_ta_1->stts               = $request->stts;
            $bimbingan_ta_1->catatan            = $request->catatan;
            $bimbingan_ta_1->update();

            return \redirect('bimbingan-ta')->with('success', 'Data Berhasil Diperbarui!');
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
        $bimbingan_ta_2 = BimbinganTA2::find($id);
        if ($bimbingan_ta_2->laporan_ta) {
            Storage::delete($bimbingan_ta_2->laporan_ta);
        }
        $bimbingan_ta_2->delete();

        return \redirect('bimbingan-ta')->with('success', 'Data Berhasil Dihapus!');
    }
}
