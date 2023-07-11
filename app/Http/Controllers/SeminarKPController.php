<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\DaftarKP;
use App\Models\SeminarKP;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\BimbinganKP;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SeminarKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $thn         = new TahunAkademik();
        $last_year   = $thn->orderBy('id', 'desc')->first();
        $thnakademik = $thn->latest('id')->limit(5)->get();
        $dosen       = Dosen::all();

        $s_kp        = new SeminarKP();
        $seminarkp   = $s_kp->latest()->get();
        $registerSeminar = $s_kp->registerSeminar();
        $sSelesai    = $s_kp->s_Selesai();
        $sTerjadwal  = $s_kp->s_Terjadwal();
        $sProses     = $s_kp->s_Proses();
        $filterStts  = $s_kp->filter();
        $seminarmhs  = $s_kp->m_seminar();

        $d_kp        = new DaftarKP();
        $b_kp        = new BimbinganKP();
        // $daftarkp    = $d_kp->d_kp_diterima();
        $mhskps      = $d_kp->mhskps();
        $daftarkp      = $d_kp->SyaratSeminar();

        $pengumuman  = Pengumuman::get()->first();

        // testing
        // $cek = Auth::user()->biodata->mahasiswa->daftarkp[0]->bimbingankp->count();

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
            'sProses',
            'pengumuman',
            'registerSeminar',
            'last_year'
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
                // 'mahasiswa_id'      => 'required',
                'daftarkp_id'       => 'required|unique:seminar_kp',
                'form_bimbingan'    => 'required|image|file|max:1024',
                'ket_selesai'    => 'required|image|file|max:1024',
                // 'tgl_seminar'    => 'required',
                'thn_akademik_id'   => 'required',
                'stts_seminar'      => 'required',
                'judul'             => 'required'
            ],
            [
                'daftarkp_id.unique' => 'The Mahasiswa has already been taken'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('seminar-kp')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation);
        } else {

            SeminarKP::create([
                // 'mahasiswa_id'   => $request->mahasiswa_id,
                'daftarkp_id'     => $request->daftarkp_id,
                'form_bimbingan'  => $request->file('form_bimbingan')->store('post-images'),
                'ket_selesai'     => $request->file('ket_selesai')->store('surat-selesai-kp'),
                'tgl_seminar'     => $request->tgl_seminar,
                'jam_seminar'     => $request->jam_seminar,
                'judul'           => $request->judul,
                'thn_akademik_id' => $request->thn_akademik_id,
                'stts_seminar'    => $request->stts_seminar,
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
                // 'mahasiswa_id'      => 'required',
                'daftarkp_id'       => 'required|unique:seminarkp',
                'form_bimbingan'    => 'image|file|max:1024',
                'ket_selesai'       => 'image|file|max:1024',
                // 'tgl_seminar'    => 'required',
                // 'jam_seminar'    => 'required',
                'stts_seminar'      => 'required',
                'judul'             => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('seminar-kp')->with('warning', 'Data Gagal Diperbarui!')
                ->withErrors($validation);
        } else {

            $seminarkp = SeminarKP::findOrFail($id);
            if ($request->file('form_bimbingan')) {
                if ($request->oldImaage) {
                    Storage::delete($request->oldImage);
                }
                $seminarkp->form_bimbingan = $request->file('form_bimbingan')->store('post-images');
            }
            if ($request->file('ket_selesai')) {
                if ($request->oldImaage1) {
                    Storage::delete($request->oldImage1);
                }
                $seminarkp->ket_selesai = $request->file('ket_selesai')->store('surat-selesai-kp');
            }

            // $seminarkp->mahasiswa_id    = $request->mahasiswa_id;
            $seminarkp->daftarkp_id     = $request->daftarkp_id;
            $seminarkp->tgl_seminar     = $request->tgl_seminar;
            $seminarkp->jam_seminar     = $request->jam_seminar;
            $seminarkp->stts_seminar    = $request->stts_seminar;
            $seminarkp->judul           = $request->judul;
            $seminarkp->thn_akademik_id = $request->thn_akademik_id;
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
