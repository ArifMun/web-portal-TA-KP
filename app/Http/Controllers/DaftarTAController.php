<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DaftarTA;
use App\Models\FormAkses;
use App\Models\Mahasiswa;
use App\Models\SeminarKP;
use App\Models\Konsentrasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaftarTAController extends Controller
{

    public function index()
    {
        $existTA = Auth::user()->level == 0 && Auth::user()->biodata->mahasiswa->daftarta->count() != 0;
        $newRegisterTA = Auth::user()->level == 0 && Auth::user()->biodata->mahasiswa->daftarta->count() == 0;

        $thn         = new TahunAkademik();
        $thnakademik = $thn->latest('id')->limit(5)->get();
        $last_year   = $thn->orderBy('id', 'desc')->first();

        $s_kp        = new SeminarKP();
        $mhs_dDaftar = $s_kp->daftar_ta();
        $mhsDaftar   = $s_kp->m_daftar_ta();

        $d_ta        = new DaftarTA();
        $filterStts  = $d_ta->filter();
        $d_diterima  = $d_ta->d_diterima();
        $d_tertunda  = $d_ta->d_tertunda();
        $d_ditolak   = $d_ta->d_ditolak();
        $mhsta       = $d_ta->m_list_ta();
        $nextTA      = $d_ta->nextta();

        $mahasiswa   = Mahasiswa::with('biodata')->get();
        $mhsAuth     = Auth::user()->biodata->mahasiswa;
        $daftarta    = DaftarTA::with('mahasiswa', 'tahunakademik')->latest()->get();
        $dosen       = Dosen::all();
        $konsentrasi = Konsentrasi::all();
        $pengumuman  = Pengumuman::get()->first();
        $formakses   = FormAkses::get()->first();

        return \view('tugas-akhir.daftar-ta', \compact(
            'daftarta',
            'mhs_dDaftar',
            'dosen',
            'thnakademik',
            'konsentrasi',
            'mhsta',
            'mhsDaftar',
            'filterStts',
            'd_diterima',
            'd_tertunda',
            'd_ditolak',
            'formakses',
            'pengumuman',
            'mahasiswa',
            'mhsAuth',
            'last_year',
            'existTA',
            'newRegisterTA',
            'nextTA',
        ));
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
                'mahasiswa_id'      => ['required', Rule::unique('daftar_ta')
                    ->where('thn_akademik_id', $request->thn_akademik_id)],
                'd_pembimbing_1'    => 'required',
                'd_pembimbing_2'    => 'required',
                'stts_pengajuan'    => 'required',
                'ganti_pembimbing'  => 'required',
                'stts_ta'           => 'required',
                // 'krs'               => 'required|image|file',
                // 'thn_akademik_id'   => 'required',
                'konsentrasi'       => 'required'
            ],
            [
                'mahasiswa_id.unique' => 'The Mahasiswa has already been taken'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('daftar-ta')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation)
                ->withInput();
        } else {
            $input  = $request->input('konsentrasi');
            $string = \implode(',', $input);

            DaftarTA::create([
                'mahasiswa_id'      => $request->mahasiswa_id,
                'd_pembimbing_1'    => $request->d_pembimbing_1,
                'd_pembimbing_2'    => $request->d_pembimbing_2,
                'judul'             => $request->judul,
                'ganti_pembimbing'  => $request->ganti_pembimbing,
                'pembimbing_lama_1' => $request->pembimbing_lama_1,
                'pembimbing_lama_2' => $request->pembimbing_lama_2,
                'stts_pengajuan'    => $request->stts_pengajuan,
                'stts_ta'           => $request->stts_ta,
                // 'krs'               => $request->file('krs')->store('file-krs'),
                'thn_akademik_id'   => $request->thn_akademik_id,
                'konsentrasi'       => $string
            ]);

            return \redirect('daftar-ta')->with('success', 'Data Berhasil Disimpan!');
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
                'mahasiswa_id'     => 'required',
                'd_pembimbing_1'   => 'required',
                'd_pembimbing_2'   => 'required',
                'ganti_pembimbing' => 'required',
                'stts_pengajuan'   => 'required',
                'stts_ta'          => 'required',
                // 'krs'              => 'file|image',
                'thn_akademik_id'  => 'required',
                'konsentrasi'      => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('daftar-ta')->with('warning', 'Data Gagal Diperbarui!')
                ->withErrors($validation)
                ->withInput();
        } else {

            $daftarta = DaftarTA::findOrFail($id);
            // if ($request->file('krs')) {
            //     if ($request->oldImage) {
            //         Storage::delete($request->oldImage);
            //     }
            //     $daftarta->krs = $request->file('krs')->store('file-krs');
            // }

            $input  = $request->input('konsentrasi');
            $string = \implode(',', $input);

            $daftarta->mahasiswa_id        = $request->mahasiswa_id;
            $daftarta->d_pembimbing_1      = $request->d_pembimbing_1;
            $daftarta->d_pembimbing_2      = $request->d_pembimbing_2;
            $daftarta->thn_akademik_id     = $request->thn_akademik_id;
            $daftarta->judul               = $request->judul;
            $daftarta->ganti_pembimbing    = $request->ganti_pembimbing;
            $daftarta->pembimbing_lama_1   = $request->pembimbing_lama_1;
            $daftarta->pembimbing_lama_2   = $request->pembimbing_lama_2;
            $daftarta->stts_pengajuan      = $request->stts_pengajuan;
            $daftarta->stts_ta             = $request->stts_ta;
            $daftarta->konsentrasi         = $string;
            $daftarta->update();

            return \redirect('daftar-ta')->with('success', 'Data Berhasil Diperbarui!');
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
        $daftarta = DaftarTA::findOrFail($id);
        if ($daftarta->krs) {
            Storage::delete($daftarta->krs);
        }

        $daftarta->delete();
        return \redirect('daftar-ta')->with('success', 'Data Berhasil Dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $daftarkp = DaftarTA::findOrFail($id);
        $daftarkp->stts_pengajuan   = $request->stts_pengajuan;
        $daftarkp->update();
        return \redirect('daftar-ta')->with('success', 'Status Pengajuan Berhasil Diperbarui!');
    }
}
