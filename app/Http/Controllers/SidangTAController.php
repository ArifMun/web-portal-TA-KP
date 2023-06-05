<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DaftarTA;
use App\Models\SidangTA;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SidangTAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_list   = SidangTA::all();

        $list     = new SidangTA();
        $m_list   = $list->m_list_sidang();

        $dosen    = Dosen::all();
        $thnakademik = TahunAkademik::latest('id')->limit(5)->get();
        $filterStts  = $s_list->filter();

        $d_ta     = new DaftarTA();
        $d_mhs_ta = $d_ta->m_ta_diterima();
        $daftarta = $d_ta->d_diterima();
        return \view('tugas-akhir.sidang-ta', \compact(
            's_list',
            'dosen',
            'd_mhs_ta',
            'daftarta',
            'm_list',
            'thnakademik',
            'filterStts'
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
                // 'mahasiswa_id'      => 'required',
                'daftar_ta_id'      => 'required',
                'f_bimbingan_1'     => 'required|image|file|max:1024',
                'f_bimbingan_2'     => 'required|image|file|max:1024',
                'slip_pembayaran'   => 'required|image|file|max:1024',
                'judul'             => 'required',
                'tgl_sidang'        => 'required|date',
                'jam_sidang'        => 'required',
                'stts_sidang'       => 'required',
                'd_penguji'         => 'required'
            ]
        );
        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('sidang-ta')->with('warning', 'Data Tidak Tersimpan!');
        } else {

            SidangTA::create([
                // 'mahasiswa_id'      => $request->mahasiswa_id,
                'daftar_ta_id'      => $request->daftar_ta_id,
                'd_penguji'         => $request->d_penguji,
                'f_bimbingan_1'     => $request->file('f_bimbingan_1')->store('form-b1'),
                'f_bimbingan_2'     => $request->file('f_bimbingan_2')->store('form-b2'),
                'slip_pembayaran'   => $request->file('slip_pembayaran')->store('slip-ta'),
                'judul'             => $request->judul,
                'catatan'           => $request->catatan,
                'tgl_sidang'        => $request->tgl_sidang,
                'jam_sidang'        => $request->jam_sidang,
                'stts_sidang'       => $request->stts_sidang,
            ]);

            return \redirect('sidang-ta')->with('success', 'Data Berhasil Disimpan');
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

    /*
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
                // 'mahasiswa_id'      => 'required',
                'daftar_ta_id'      => 'required',
                'd_penguji'         => 'required',
                'f_bimbingan_1'     => 'image|file|max:1024',
                'f_bimbingan_2'     => 'image|file|max:1024',
                'slip_pembayaran'   => 'image|file|max:1024',
                'judul'             => 'required',
                'tgl_sidang'        => 'required',
                'jam_sidang'        => 'required',
                'stts_sidang'       => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('sidang-ta')->with('warning', 'Data Tidak Tersimpan');
        } else {

            $sidang_ta = SidangTA::findOrFail($id);
            if ($request->file('f_bimbingan_1')) {
                if ($request->oldImage1) {
                    Storage::delete($request->oldImage1);
                }
                $sidang_ta->f_bimbingan_1 = $request->file('f_bimbingan_1')->store('form-b1');
            }

            if ($request->file('f_bimbingan_2')) {
                if ($request->oldImage2) {
                    Storage::delete($request->oldImage2);
                }
                $sidang_ta->f_bimbingan_2 = $request->file('f_bimbingan_2')->store('form-b2');
            }

            if ($request->file('slip_pembayaran')) {
                if ($request->oldImage3) {
                    Storage::delete($request->oldImage3);
                }
                $sidang_ta->slip_pembayaran = $request->file('slip_pembayaran')->store('slip-ta');
            }

            // $sidang_ta->mahasiswa_id    = $request->mahasiswa_id;
            $sidang_ta->daftar_ta_id    = $request->daftar_ta_id;
            $sidang_ta->d_penguji       = $request->d_penguji;
            $sidang_ta->judul           = $request->judul;
            $sidang_ta->catatan         = $request->catatan;
            $sidang_ta->tgl_sidang      = $request->tgl_sidang;
            $sidang_ta->jam_sidang      = $request->jam_sidang;
            $sidang_ta->stts_sidang     = $request->stts_sidang;
            $sidang_ta->update();

            return \redirect('sidang-ta')->with('success', 'Data Berhasil Diperbarui!');
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
        $sidang_ta = SidangTA::findOrFail($id);
        if ($sidang_ta->f_bimbingan_1) {
            Storage::delete($sidang_ta->f_bimbingan_1);
        }
        if ($sidang_ta->f_bimbingan_2) {
            Storage::delete($sidang_ta->f_bimbingan_2);
        }
        if ($sidang_ta->slip_pembayaran) {
            Storage::delete($sidang_ta->slip_pembayaran);
        }

        $sidang_ta->delete();
        return \redirect('sidang-ta')->with('success', 'Data Berhasil Dihapus!');
    }
}
