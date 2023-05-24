<?php

namespace App\Http\Controllers;

use id;
use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\DaftarKP;
use App\Models\SeminarKP;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class SeminarKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_kp        = new SeminarKP();
        $d_kp        = new DaftarKP();
        $seminarkp   = SeminarKP::all();
        $thnakademik = TahunAkademik::latest('id')->limit(5)->get();
        $dosen       = Dosen::all();
        $sSelesai    = $s_kp->s_Selesai();
        $sTerjadwal  = $s_kp->s_Terjadwal();
        $sProses     = $s_kp->s_Proses();
        $filterStts  = $s_kp->filter();
        $daftarkp    = $d_kp->d_kp_diterima();
        $mhskps      = $d_kp->m_kp_diterima();
        $seminarmhs = $s_kp->m_seminar();

        return \view('kerja-praktik.seminar-kp', \compact(
            'seminarkp',
            'seminarmhs',
            'dosen',
            'daftarkp',
            'mhskps',
            'thnakademik',
            'filterStts',
            'sSelesai',
            'sTerjadwal',
            'sProses'
        ));
    }

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
                'mahasiswa_id'      => 'required',
                'daftarkp_id'       => 'required|unique:seminar_kp',
                'form_bimbingan'    => 'required|image|file',
                // 'tgl_seminar'    => 'required',
                // 'jam_seminar'    => 'required',
                'stts_seminar'      => 'required',
                'judul'             => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('seminar-kp')->with('warning', 'Data Tidak Tersimpan!');
        } else {
            $seminarkp = SeminarKP::create([
                'mahasiswa_id'   => $request->mahasiswa_id,
                'daftarkp_id'    => $request->daftarkp_id,
                'form_bimbingan' => $request->file('form_bimbingan')->store('post-images'),
                'tgl_seminar'    => $request->tgl_seminar,
                'jam_seminar'    => $request->jam_seminar,
                'judul'          => $request->judul,
                'catatan'        => $request->catatan,
                'stts_seminar'   => $request->stts_seminar,
            ]);

            return \redirect('seminar-kp')->with('success', 'Data Berhasil Disimpan!');
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
                'mahasiswa_id'      => 'required',
                'daftarkp_id'       => 'required',
                'form_bimbingan'    => 'image|file',
                // 'tgl_seminar'    => 'required',
                // 'jam_seminar'    => 'required',
                'stts_seminar'      => 'required',
                'judul'             => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('seminar-kp')->with('warning', 'Data Gagal Diperbarui!');
        } else {

            $seminarkp = SeminarKP::findOrFail($id);
            if ($request->file('form_bimbingan')) {
                if ($request->oldImaage) {
                    Storage::delete($request->oldImage);
                }
                $seminarkp->form_bimbingan = $request->file('form_bimbingan')->store('post-images');
            }

            $seminarkp->mahasiswa_id    = $request->mahasiswa_id;
            $seminarkp->daftarkp_id     = $request->daftarkp_id;
            $seminarkp->tgl_seminar     = $request->tgl_seminar;
            $seminarkp->jam_seminar     = $request->jam_seminar;
            $seminarkp->stts_seminar    = $request->stts_seminar;
            $seminarkp->judul           = $request->judul;
            $seminarkp->catatan         = $request->catatan;
            $seminarkp->update();

            return \redirect('seminar-kp')->with('success', 'Data Berhasil Diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeminarKP $seminarkp, $id)
    {

        $seminarkp = SeminarKP::find($id);
        if ($seminarkp->form_bimbingan) {
            Storage::delete($seminarkp->form_bimbingan);
        }

        $seminarkp->delete();
        return \redirect('seminar-kp')->with('success', 'Data Berhasil Dihapus!');
    }
}
