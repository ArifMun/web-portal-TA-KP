<?php

namespace App\Http\Controllers;

use App\Models\DaftarTA;
use App\Models\Dosen;
use App\Models\Konsentrasi;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DaftarTAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarta    = DaftarTA::all();
        $mhs         = Mahasiswa::all();
        $dosen       = Dosen::all();
        $thnakademik = TahunAkademik::all();
        $konsentrasi = Konsentrasi::all();
        $mhsDaftar   = Auth::user()->biodata->mahasiswa;
        $mhsta       =  DaftarTA::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get();

        return \view('tugas-akhir.daftar-ta', \compact(
            'daftarta',
            'mhs',
            'dosen',
            'thnakademik',
            'konsentrasi',
            'mhsta',
            'mhsDaftar'
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
                'krs'               => 'required|image|file',
                'thn_akademik_id'   => 'required',
                'konsentrasi'       => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('daftar-ta')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation);
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
                'krs'               => $request->file('krs')->store('file-krs'),
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
