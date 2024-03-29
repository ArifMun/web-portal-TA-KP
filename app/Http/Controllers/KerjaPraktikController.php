<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\DaftarKP;
use App\Models\FormAkses;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KerjaPraktikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $existKp = Auth::user()->level == 0 && Auth::user()->biodata->mahasiswa->daftarkp->count() != 0;
        $newRegisterKp = Auth::user()->level == 0 && Auth::user()->biodata->mahasiswa->daftarkp->count() == 0;

        $daftar_kp   = new DaftarKP();
        $mhskps      = $daftar_kp->authDaftarKP();
        $nextkp      = $daftar_kp->nextkp();
        $kpDiterima  = $daftar_kp->where('stts_pengajuan', '=', 'diterima')->get()->count();
        $kpTertunda  = $daftar_kp->where('stts_pengajuan', '=', 'tertunda')->get()->count();
        $kpDitolak   = $daftar_kp->where('stts_pengajuan', '=', 'ditolak')->get()->count();
        $daftarkp    = $daftar_kp->with('mahasiswa', 'tahunakademik')->latest()->get();
        $filterStts  = $daftar_kp->distinct()->select('stts_pengajuan')->get();

        $thn         = new TahunAkademik();
        $last_year   = $thn->orderBy('id', 'desc')->first();
        $thnakademik = $thn->latest('id')->limit(5)->get();

        $dosen       = Dosen::with('biodata')->get();
        $konsentrasi = Konsentrasi::all();
        $mahasiswa   = Mahasiswa::with('biodata')->get();
        $mhskp       = Auth::user()->biodata->mahasiswa;
        $pengumuman  = Pengumuman::get()->first();

        $formakses = FormAkses::get()->first();

        return \view('kerja-praktik.daftar-kp', \compact(
            'daftarkp',
            'mahasiswa',
            'dosen',
            'thnakademik',
            'konsentrasi',
            'mhskp',
            'mhskps',
            'formakses',
            'filterStts',
            'kpDiterima',
            'kpTertunda',
            'kpDitolak',
            'pengumuman',
            'last_year',
            'newRegisterKp',
            'existKp',
            'nextkp',
        ));
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
                'mahasiswa_id'        => ['required', Rule::unique('daftar_kp')
                    ->where('thn_akademik_id', $request->thn_akademik_id)],
                'd_pembimbing_1'    => 'required',
                'd_pembimbing_2'    => 'required',
                // 'd_pembimbing_3'    => 'required',
                'stts_pengajuan'    => 'required',
                'stts_kp'           => 'required',
                'ganti_pembimbing'  => 'required',
                'semester'          => 'required|numeric|min:6|max:14',
                'slip_pembayaran'   => 'required|image|file|max:1024',
                'sertifikat_makrab' => 'required|image|file|max:1024',
                // 'thn_akademik_id'   => 'required',
                'konsentrasi'       => 'required',
            ],
            [
                'mahasiswa_id.unique' => 'The NIM has already been taken'
            ]
        );

        // dd($validation);
        if ($validation->fails()) {
            return \redirect('kerja-praktik')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation)
                ->withInput();
        } else {

            $input = $request->input('konsentrasi');
            $string = \implode(',', $input);

            // DaftarKP::create($string);
            DaftarKP::create([
                'mahasiswa_id'      => $request->mahasiswa_id,
                'd_pembimbing_1'    => $request->d_pembimbing_1,
                'd_pembimbing_2'    => $request->d_pembimbing_2,
                'pembimbing_lama'   => $request->pembimbing_lama,
                'judul'             => $request->judul,
                'tempat_kp'         => $request->tempat_kp,
                'stts_pengajuan'    => $request->stts_pengajuan,
                'stts_kp'           => $request->stts_kp,
                'ganti_pembimbing'  => $request->ganti_pembimbing,
                'semester'          => $request->semester,
                'slip_pembayaran'   => $request->file('slip_pembayaran')->store('post-images'),
                'sertifikat_makrab' => $request->file('sertifikat_makrab')->store('post-images'),
                'thn_akademik_id'   => $request->thn_akademik_id,
                'konsentrasi'       => $string,
            ]);
            return \redirect('kerja-praktik')->with('success', 'Data Berhasil Disimpan!');
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
    // public function edit(DaftarKP $daftarkp)
    // {
    //     $daftarkp = DaftarKP::findOrFail($daftarkp->id);
    // }

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
                'd_pembimbing_1'    => 'required',
                'd_pembimbing_2'    => 'required',
                'stts_pengajuan'    => 'required',
                'stts_kp'           => 'required',
                'ganti_pembimbing'  => 'required',
                'semester'          => 'required|numeric|min:6|max:14',
                'slip_pembayaran'   => 'image|file|max:1024',
                'thn_akademik_id'   => 'required',
                'konsentrasi'       => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            $dataToBeUpdated = DaftarKP::findOrFail($id);
            return \redirect('kerja-praktik')->with('warning', 'Data Gagal Diperbarui!')
                ->with('showModalEdit', true)
                ->withErrors($validation)
                ->withInput();
        } else {

            $daftarkp = DaftarKP::findOrFail($id);
            if ($request->file('slip_pembayaran')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $daftarkp->slip_pembayaran  = $request->file('slip_pembayaran')->store('post-images');
            }

            if ($request->file('sertifikat_makrab')) {
                if ($request->oldImage1) {
                    Storage::delete($request->oldImage1);
                }
                $daftarkp->sertifikat_makrab  = $request->file('sertifikat_makrab')->store('post-images');
            }
            $input = $request->input('konsentrasi');
            $string = \implode(',', $input);

            $daftarkp->mahasiswa_id     = $request->mahasiswa_id;
            $daftarkp->d_pembimbing_1   = $request->d_pembimbing_1;
            $daftarkp->d_pembimbing_2   = $request->d_pembimbing_2;
            $daftarkp->pembimbing_lama  = $request->pembimbing_lama;
            $daftarkp->stts_pengajuan   = $request->stts_pengajuan;
            $daftarkp->stts_kp          = $request->stts_kp;
            $daftarkp->ganti_pembimbing = $request->ganti_pembimbing;
            $daftarkp->judul            = $request->judul;
            $daftarkp->tempat_kp        = $request->tempat_kp;
            $daftarkp->semester         = $request->semester;
            $daftarkp->thn_akademik_id  = $request->thn_akademik_id;
            $daftarkp->konsentrasi      = $string;
            $daftarkp->update();

            return \redirect('kerja-praktik')->with('success', 'Data Berhasil Diperbarui!');
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

        $daftarkp = DaftarKP::find($id);
        if ($daftarkp->slip_pembayaran) {
            Storage::delete($daftarkp->slip_pembayaran);
        }

        if ($daftarkp->sertifikat_makrab) {
            Storage::delete($daftarkp->sertifikat_makrab);
        }
        $daftarkp->delete();
        return \redirect('kerja-praktik')->with('success', 'Data Berhasil Dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $daftarkp = DaftarKP::findOrFail($id);
        $daftarkp->stts_pengajuan   = $request->stts_pengajuan;
        $daftarkp->update();
        return \redirect('kerja-praktik')->with('success', 'Status Pengajuan Berhasil Diperbarui!');
    }
}
