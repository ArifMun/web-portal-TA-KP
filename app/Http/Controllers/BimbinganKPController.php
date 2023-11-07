<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\DaftarKP;
use Barryvdh\DomPDF\PDF;
use App\Models\Pengumuman;
use App\Models\BimbinganKP;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf as PdfMpdf;

class BimbinganKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $daftarkp    = DaftarKP::all();
        $filterStts  = BimbinganKP::distinct()->select('stts')->get();
        $thnakademik = TahunAkademik::all();
        $bimbingkp   = BimbinganKP::all();

        $daftar_kp  = new DaftarKP();
        $mhskps     = $daftar_kp->mhskps();
        $mhskpd     = $daftar_kp->mhskpd();

        $bimbing_kp     = new BimbinganKP();
        $sttsDosen      = $bimbing_kp->sttsDosen();
        $sttsMhs        = $bimbing_kp->sttsMhs();
        $bimbingMhs     = $bimbing_kp->bimbingMhs()->sortByDesc('id');
        $bimbingDosen   = $bimbing_kp->bimbingDosen();
        $pengumuman     = Pengumuman::get()->first();

        $list = BimbinganKP::select('daftarkp_id')->groupBy('daftarkp_id')->get();

        return \view('kerja-praktik.bimbingan-kp', \compact(
            'thnakademik',
            'daftarkp',
            'bimbingMhs',
            'bimbingDosen',
            'mhskps',
            'bimbingkp',
            'list',
            'mhskpd',
            'filterStts',
            'sttsDosen',
            'sttsMhs',
            'pengumuman'
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
                // 'judul_bimbingan'   => 'required',
                'author'            => 'required',
                'stts'              => 'required',
                // 'tgl_bimbingan'     => 'required'
                // 'laporan_kp'        => 'required|file|max:1024',
                // 'catatan'           => 'required',
            ]
        );
        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-kp')->with('warning', 'Data Tidak Tersimpan!');
        } else {

            BimbinganKP::create([
                'daftarkp_id'       => $request->daftarkp_id,
                // 'dosen_id'          => $request->dosen_id,
                // 'mahasiswa_id'      => $request->mahasiswa_id,
                'judul_bimbingan'   => $request->judul_bimbingan,
                'catatan'           => $request->catatan,
                'tgl_bimbingan'     => $request->tgl_bimbingan,
                'stts'              => $request->stts,
                'author'            => $request->author,
                'laporan_kp'        => $request->hasFile('laporan_kp') ? $request->file('laporan_kp')->store('dokumen-kp') : null
            ]);

            return \back()->with('success', 'Data Berhasil Disimpan!');
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

        $daftarkp    = DaftarKP::all();
        $filterStts  = BimbinganKP::distinct()->select('stts')->get();
        $thnakademik = TahunAkademik::all();
        $bimbingkp   = BimbinganKP::all();

        $daftar_kp  = new DaftarKP();
        $mhskps     = $daftar_kp->mhskps();
        $mhskpd     = $daftar_kp->mhskpd()->where('id', '=', $id);
        $bimbing_kp     = new BimbinganKP();

        $sttsDosen      = $bimbing_kp->sttsDosen();
        $sttsMhs        = $bimbing_kp->sttsMhs();
        $bimbingMhs     = $bimbing_kp->bimbingDosen();
        $bimbingDosen   = $bimbing_kp->bimbinganDetail()->where('daftarkp_id', '=', $id);

        return \view('kerja-praktik.detail-bimbingan-kp', \compact(
            'thnakademik',
            'daftarkp',
            'bimbingMhs',
            'bimbingDosen',
            'mhskps',
            'bimbingkp',
            'mhskpd',
            'filterStts',
            'sttsDosen',
            'sttsMhs',
        ));
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
                // 'judul_bimbingan'   => 'required',
                'author'            => 'required',
                'stts'              => 'required',
                // 'laporan_kp'        => 'file|max:1024',
                // 'catatan'           => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('bimbingan-kp')->with('warning', 'Data Gagal Diperbarui');
        } else {
            $bimbingankp = BimbinganKP::findOrFail($id);
            if ($request->file('laporan_kp')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $bimbingankp->laporan_kp = $request->file('laporan_kp')->store('dokumen-kp');
            }

            $bimbingankp->daftarkp_id     = $request->daftarkp_id;
            // $bimbingankp->mahasiswa_id    = $request->mahasiswa_id;
            // $bimbingankp->dosen_id        = $request->dosen_id;
            $bimbingankp->judul_bimbingan = $request->judul_bimbingan;
            $bimbingankp->author          = $request->author;
            $bimbingankp->stts            = $request->stts;
            $bimbingankp->catatan         = $request->catatan;
            $bimbingankp->tgl_bimbingan   = $request->tgl_bimbingan;
            $bimbingankp->update();

            return \back()->with('success', 'Data Berhasil Diperbarui!');
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
        $bimbingankp = BimbinganKP::find($id);
        if ($bimbingankp->laporan_kp) {
            Storage::delete($bimbingankp->laporan_kp);
        }
        $bimbingankp->delete();

        return \back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function print()
    {
        $kp             = new BimbinganKP();
        $bimbingankp    = $kp->bimbingMhs()->where('stts', '!=', 'proses');
        $daftar_kp  = new DaftarKP();
        $mhskps     = $daftar_kp->mhskps();
        // $printPDF       = PDF::loadView('kerja-praktik.form-bimbingan-kp', \compact('bimbingankp'));
        // $printPDF->setPaper('A4', 'potrait');
        // return $printPDF->stream('form-bimbingan-pdf');

        $dompdf = new Dompdf();
        // $dompdf->setIsRemoteEnabled(true);

        // Load template view atau HTML yang ingin Anda cetak
        $html = view('kerja-praktik.form-bimbingan-kp', \compact('bimbingankp', 'mhskps'))->render();

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Set nama file PDF yang akan didownload
        $filename = 'print.pdf';

        // Mengirimkan file PDF untuk didownload
        return $dompdf->stream($filename, ['Attachment' => false]);
    }

    public function updateStatus(Request $request, $id)
    {
        $daftarkp = BimbinganKP::findOrFail($id);
        $daftarkp->stts   = $request->stts;
        $daftarkp->update();
        return \back()->with('success', 'Status Bimbingan Berhasil Diperbarui!');
    }
}