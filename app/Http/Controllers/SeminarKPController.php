<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\DaftarKP;
use App\Models\SeminarKP;
use App\Models\Pengumuman;
use App\Models\BimbinganKP;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;

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
        $daftarkp    = $d_kp->SyaratSeminar();
        $mhskps      = $d_kp->mhskps();

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
                ->withErrors($validation)
                ->withInput();
        } else {

            SeminarKP::create([
                // 'mahasiswa_id'   => $request->mahasiswa_id,
                'daftarkp_id'     => $request->daftarkp_id,
                'form_bimbingan'  => $request->file('form_bimbingan')->store('post-images'),
                'ket_selesai'     => $request->file('ket_selesai')->store('surat-selesai-kp'),
                'tgl_seminar'     => $request->tgl_seminar,
                'jam_seminar'     => $request->jam_seminar,
                'judul'           => $request->judul,
                'tempat'          => $request->tempat,
                'tempat_seminar'  => $request->tempat_seminar,
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
                // 'daftarkp_id'       => 'required|unique:seminar_kp',
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
                ->withErrors($validation)
                ->withInput();
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
            $seminarkp->tempat          = $request->tempat;
            $seminarkp->tempat_seminar  = $request->tempat_seminar;
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

    public function updateStatus(Request $request, $id)
    {
        $daftarkp = SeminarKP::findOrFail($id);
        $daftarkp->stts_seminar   = $request->stts_seminar;
        $daftarkp->update();
        return \redirect('seminar-kp')->with('success', 'Status Seminar Berhasil Diperbarui!');
    }

    public function printFormSeminar(Request $request, $id)
    {
        // $kp             = new DaftarKP();
        $seminarkp = SeminarKP::findOrFail($id);
        $biodata   = Biodata::all();
        $dompdf = new Dompdf();
        // $dompdf->setIsRemoteEnabled(true);

        // Load template view atau HTML yang ingin Anda cetak
        $html = view('kerja-praktik.form-seminar', \compact('seminarkp', 'biodata'))->render();

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Set nama file PDF yang akan didownload
        $filename = 'form-seminar.pdf';

        // Mengirimkan file PDF untuk didownload
        return $dompdf->stream($filename, ['Attachment' => false]);
    }
}
