<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\DaftarKP;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class MhsKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarKP = DaftarKP::all();
        $daftarkp = DaftarKP::join('biodata', 'biodata.id', '=', 'daftar_kp.biodata_id')
            ->join('konsentrasi', 'konsentrasi.id', '=', 'daftar_kp.konsentrasi_id')
            ->join('thn_akademik', 'thn_akademik.id', '=', 'daftar_kp.thn_akademik_id')
            ->select('biodata.*', 'konsentrasi.*', 'thn_akademik.*', 'daftar_kp.*')
            ->where('jabatan', '=', 'mahasiswa')
            ->get()
            ->sortDesc();

        $dosen = Biodata::where('jabatan', '=', 'dosen')
            ->get();

        $thnakademik = TahunAkademik::all();
        $konsentrasi = Konsentrasi::all();
        $biodata = Biodata::where('jabatan', '=', 'mahasiswa')
            ->get();

        $mhskp = Auth::user()->biodata;
        // $mhs = ::find();

        return \view('kerja-praktik.mhs-kp', \compact('daftarkp', 'biodata', 'dosen', 'thnakademik', 'konsentrasi', 'mhskp', 'daftarKP'));
    }

    public function autofill($id)
    {
        $data = Biodata::find($id);
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
                'biodata_id'        => ['required', Rule::unique('daftar_kp')
                    ->where('thn_akademik_id', $request->thn_akademik_id)],
                // 'nim'    => 'required',
                // 'nama'    => 'required',
                'd_pembimbing_1'    => 'required',
                'd_pembimbing_2'    => 'required',
                'stts_pengajuan'    => 'required',
                'stts_kp'           => 'required',
                'ganti_pembimbing'  => 'required',
                'semester'          => 'required',
                'slip_pembayaran'   => 'required|image|file',
                'thn_akademik_id'   => 'required',
                'konsentrasi_id'    => 'required',
            ]
        );

        // dd($validation);
        if ($validation->fails()) {
            return \redirect('mhs-kp')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation);
        } else {
            if (Auth::user()->level == 0) {
                $daftarkp = DaftarKP::create([
                    'biodata_id'        => $request->biodata_id,
                    // 'nim'               => $request->nim,
                    // 'nama'              => $request->nama,
                    'd_pembimbing_1'    => $request->d_pembimbing_1,
                    'd_pembimbing_2'    => $request->d_pembimbing_2,
                    // 'd_pembimbing_3'    => $request->d_pembimbing_3,
                    'stts_pengajuan'    => $request->stts_pengajuan,
                    'stts_kp'           => $request->stts_kp,
                    'ganti_pembimbing'  => $request->ganti_pembimbing,
                    'semester'          => $request->semester,
                    'slip_pembayaran'   => $request->file('slip_pembayaran')->store('post-images'),
                    'thn_akademik_id'   => $request->thn_akademik_id,
                    'konsentrasi_id'    => $request->konsentrasi_id,
                ]);
                return \redirect('mhs-kp')->with('success', 'Data Berhasil Disimpan!');
            } else {
                $daftarkp = DaftarKP::create([
                    'biodata_id'        => $request->biodata_id,
                    // 'nim'               => $request->nim,
                    // 'nama'              => $request->nama,
                    'd_pembimbing_1'    => $request->d_pembimbing_1,
                    'd_pembimbing_2'    => $request->d_pembimbing_2,
                    // 'd_pembimbing_3'    => $request->d_pembimbing_3,
                    'stts_pengajuan'    => $request->stts_pengajuan,
                    'stts_kp'           => $request->stts_kp,
                    'ganti_pembimbing'  => $request->ganti_pembimbing,
                    'semester'          => $request->semester,
                    'slip_pembayaran'   => $request->file('slip_pembayaran')->store('post-images'),
                    'thn_akademik_id'   => $request->thn_akademik_id,
                    'konsentrasi_id'    => $request->konsentrasi_id,
                ]);
                return \redirect('mhs-kp')->with('success', 'Data Berhasil Disimpan!');
            }
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
    public function edit(DaftarKP $daftarkp)
    {
        $daftarkp = DaftarKP::findOrFail($daftarkp->id);
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
                'biodata_id'        => 'required',
                'd_pembimbing_1'    => 'required',
                'd_pembimbing_2'    => 'required',
                'stts_pengajuan'    => 'required',
                'stts_kp'           => 'required',
                'ganti_pembimbing'  => 'required',
                'semester'          => 'required',
                'slip_pembayaran'   => 'image|file',
                'thn_akademik_id'   => 'required',
                'konsentrasi_id'    => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('kerja-praktik')->with('warning', 'Data Gagal Di Edit!');
        } else {

            $daftarkp = DaftarKP::findOrFail($id);
            if ($request->file('slip_pembayaran')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $daftarkp->slip_pembayaran  = $request->file('slip_pembayaran')->store('post-images');
            }

            $daftarkp->biodata_id       = $request->biodata_id;
            $daftarkp->d_pembimbing_1   = $request->d_pembimbing_1;
            $daftarkp->d_pembimbing_2   = $request->d_pembimbing_2;
            $daftarkp->stts_pengajuan   = $request->stts_pengajuan;
            $daftarkp->stts_kp          = $request->stts_kp;
            $daftarkp->ganti_pembimbing = $request->ganti_pembimbing;
            $daftarkp->semester         = $request->semester;
            $daftarkp->thn_akademik_id  = $request->thn_akademik_id;
            $daftarkp->konsentrasi_id   = $request->konsentrasi_id;
            $daftarkp->update();

            return \redirect('kerja-praktik')->with('success', 'Data Berhasil Di Ubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarKP $daftarkp, $id)
    {

        $daftarkp = DaftarKP::find($id);
        if ($daftarkp->slip_pembayaran) {
            Storage::delete($daftarkp->slip_pembayaran);
        }
        $daftarkp->delete();
        return \redirect('kerja-praktik')->with('success', 'Data Berhasil Dihapus!');
    }
}
