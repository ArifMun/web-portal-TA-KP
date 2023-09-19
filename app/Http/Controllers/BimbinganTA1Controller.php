<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\DaftarTA;
use App\Models\Pengumuman;
use App\Models\BimbinganTA1;
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
    public function print()
    {
        $kp             = new BimbinganTA2();
        $bimbinganTA    = $kp->b_mhs_2()->where('stts', '!=', 'proses');
        $daftar_ta  = new DaftarTA();
        $mhstas     = $daftar_ta->inputMhsDiterima();
        // mhstas = mahasiswa tugas akhir selesai
        $dompdf = new Dompdf();

        // Load template view atau HTML yang ingin Anda cetak
        $html = view('tugas-akhir.form-bimbingan-ta-2', \compact('bimbinganTA', 'mhstas'))->render();

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Set nama file PDF yang akan didownload
        $filename = 'print.pdf';

        // Mengirimkan file PDF untuk didownload
        return $dompdf->stream($filename, ['Attachment' => false]);
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
                'judul_bimbingan' => 'required',
                // 'laporan_ta'   => 'required|file|image|max:1024',
                'stts'         => 'required',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \back()->with('warning', 'Data Tidak Tersimpan!');
        } else {

            BimbinganTA2::create([
                'daftar_ta_id'      => $request->daftar_ta_id,
                // 'dosen_id'          => $request->dosen_id,
                // 'mahasiswa_id'      => $request->mahasiswa_id,
                'judul_bimbingan'   => $request->judul_bimbingan,
                'laporan_ta'        => $request->hasFile('laporan_ta') ? $request->file('laporan_ta')->store('dokumen-ta') : null,
                'stts'              => $request->stts,
                'catatan'           => $request->catatan,
                'author'            => $request->author,
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
        $d_ta        = new DaftarTA();
        $l_ta        = $d_ta->all();

        // select pada form tambah bimbingan 1
        $m_bimbing_1 = $d_ta->m_bimbing_1(); //select untuk mhs pada form bimbing 1 dan 2
        $d_bimbing_1 = $d_ta->d_bimbing_1()->where('id', '=', $id);

        // data pembimbing 1
        $bimbing   = new BimbinganTA1();
        $e_bimbing = $bimbing->all();

        // data yang tampil pada tabel pembimbing 1
        $b_dosen_1  = $bimbing->b_dosen_1_detail()->where('daftar_ta_id', '=', $id);
        $b_mhs_1 = $bimbing->b_mhs_1()->sortByDesc('id');

        // =======================================================

        // data pembimbing 2
        $bimbing_2   = new BimbinganTA2();
        $e_bimbing_2 = $bimbing_2->all();

        // data yang tampil pada tabel pembimbing 2
        $b_dosen_2  = $bimbing_2->b_dosen_2_detail()->where('daftar_ta_id', '=', $id);
        $b_mhs_2 = $bimbing_2->b_mhs_2()->sortByDesc('id');

        // select pada form tambah bimbingan 1
        // $m_bimbing_2 = $d_ta->m_bimbing_2();
        $d_bimbing_2 = $d_ta->d_bimbing_2();
        $pengumuman  = Pengumuman::get()->first();
        return \view('tugas-akhir.detail-bimbingan-ta-2', \compact(
            'e_bimbing',
            'e_bimbing_2',
            'm_bimbing_1',
            'd_bimbing_1',
            'd_bimbing_2',
            'l_ta',
            'b_dosen_1',
            'b_mhs_1',
            'b_dosen_2',
            'b_mhs_2',
            'pengumuman'
        ));
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'judul_bimbingan' => 'required',
                'author'          => 'required',
                'stts'            => 'required',
                // 'laporan_ta'      => 'file|max:1024'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \back()->with('warning', 'Data Gagal Diperbarui');
        } else {
            $bimbingan_ta_1 = BimbinganTA2::findOrFail($id);
            if ($request->file('laporan_ta')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $bimbingan_ta_1->laporan_ta = $request->file('laporan_ta')->store('dokumen_ta');
            }

            $bimbingan_ta_1->daftar_ta_id       = $request->daftar_ta_id;
            $bimbingan_ta_1->judul_bimbingan    = $request->judul_bimbingan;
            $bimbingan_ta_1->author             = $request->author;
            $bimbingan_ta_1->stts               = $request->stts;
            $bimbingan_ta_1->catatan            = $request->catatan;
            $bimbingan_ta_1->update();

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
        $bimbingan_ta_2 = BimbinganTA2::find($id);
        if ($bimbingan_ta_2->laporan_ta) {
            Storage::delete($bimbingan_ta_2->laporan_ta);
        }
        $bimbingan_ta_2->delete();

        return \back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $daftarkp = BimbinganTA2::findOrFail($id);
        $daftarkp->stts   = $request->stts;
        $daftarkp->update();
        return \back()->with('success', 'Status Pengajuan Berhasil Diperbarui!');
    }
}