<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\DaftarTA;
use App\Models\SidangTA;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Support\Carbon;
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
        $s_list      = SidangTA::latest()->get();
        // $list_sidang =
        //     Carbon::parse($s_list->tgl_sidang)->locale('id');
        $list        = new SidangTA();
        $registerSidang = $list->registerSidang();
        $m_list      = $list->m_list_sidang();
        $s_proses    = $list->s_proses();
        $s_terjadwal = $list->s_terjadwal();
        $s_selesai   = $list->s_selesai();

        $thn         = new TahunAkademik();
        $last_year   = $thn->orderBy('id', 'desc')->first();
        $thnakademik = $thn->latest('id')->limit(5)->get();

        $dosen       = Dosen::all();
        $filterStts  = $s_list->filter();

        $d_ta     = new DaftarTA();
        $d_mhs_ta = $d_ta->m_ta_diterima();
        $daftarta = $d_ta->SyaratSidang();
        $inputMhsDiterima = $d_ta->inputMhsDiterima();

        $pengumuman  = Pengumuman::get()->first();
        return \view('tugas-akhir.sidang-ta', \compact(
            's_list',
            'dosen',
            'd_mhs_ta',
            'daftarta',
            'm_list',
            'thnakademik',
            'filterStts',
            's_proses',
            's_terjadwal',
            's_selesai',
            'pengumuman',
            'registerSidang',
            'inputMhsDiterima',
            'last_year'
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
                'daftar_ta_id'          => 'required|unique:sidang_ta',
                'f_bimbingan_1'         => 'required|image|file|max:1024',
                'f_bimbingan_2'         => 'required|image|file|max:1024',
                'slip_pembayaran_sidang'    => 'required|image|file|max:1024',
                'slip_pembayaran_skripsi'   => 'required|image|file|max:1024',
                'krs'                   => 'required|image|file|max:1024',
                'judul'                 => 'required',
                'stts_sidang'           => 'required',
                'thn_akademik_id'       => 'required'
                // 'd_penguji'         => 'required'
            ],
            [
                'daftar_ta_id' => 'The Mahasiswa has already been taken'
            ]
        );
        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('sidang-ta')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation)
                ->withInput();
        } else {

            SidangTA::create([
                'daftar_ta_id'      => $request->daftar_ta_id,
                'd_penguji'         => $request->d_penguji,
                'f_bimbingan_1'     => $request->file('f_bimbingan_1')->store('form-b1'),
                'f_bimbingan_2'     => $request->file('f_bimbingan_2')->store('form-b2'),
                'slip_pembayaran_sidang'    => $request->file('slip_pembayaran_sidang')->store('slip-sidang'),
                'slip_pembayaran_skripsi'   => $request->file('slip_pembayaran_skripsi')->store('slip-ta'),
                'krs'               => $request->file('krs')->store('krs'),
                'judul'             => $request->judul,
                'tempat'            => $request->tempat,
                'thn_akademik_id'   => $request->thn_akademik_id,
                'tgl_sidang'        => $request->tgl_sidang,
                'jam_mulai_sidang'        => $request->jam_mulai_sidang,
                'jam_akhir_sidang'        => $request->jam_akhir_sidang,
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
                // 'daftar_ta_id'      => 'requiredunique:sidang_ta',
                'f_bimbingan_1'     => 'image|file|max:1024',
                'f_bimbingan_2'     => 'image|file|max:1024',
                'slip_pembayaran_sidang'    => 'image|file|max:1024',
                'slip_pembayaran_skripsi'   => 'image|file|max:1024',
                'krs'               => 'image|file|max:1024',
                'judul'             => 'required',
                'stts_sidang'       => 'required'
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('sidang-ta')->with('warning', 'Data Tidak Tersimpan')
                ->withErrors($validation)
                ->withInput();
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

            if ($request->file('slip_pembayaran_sidang')) {
                if ($request->oldImage3) {
                    Storage::delete($request->oldImage3);
                }
                $sidang_ta->slip_pembayaran_sidang = $request->file('slip_pembayaran_sidang')->store('slip-sidang');
            }

            if ($request->file('slip_pembayaran_skripsi')) {
                if ($request->oldImage4) {
                    Storage::delete($request->oldImage4);
                }
                $sidang_ta->slip_pembayaran_skripsi = $request->file('slip_pembayaran_skripsi')->store('slip-ta');
            }

            if ($request->file('krs')) {
                if ($request->oldImage5) {
                    Storage::delete($request->oldImage5);
                }
                $sidang_ta->krs = $request->file('krs')->store('krs');
            }

            $sidang_ta->daftar_ta_id    = $request->daftar_ta_id;
            $sidang_ta->d_penguji       = $request->d_penguji;
            $sidang_ta->judul           = $request->judul;
            $sidang_ta->tempat          = $request->tempat;
            $sidang_ta->tgl_sidang      = $request->tgl_sidang;
            $sidang_ta->jam_mulai_sidang = $request->jam_mulai_sidang;
            $sidang_ta->jam_akhir_sidang = $request->jam_akhir_sidang;
            $sidang_ta->stts_sidang     = $request->stts_sidang;
            $sidang_ta->thn_akademik_id = $request->thn_akademik_id;
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
        if ($sidang_ta->slip_pembayaran_sidang) {
            Storage::delete($sidang_ta->slip_pembayaran_sidang);
        }
        if ($sidang_ta->slip_pembayaran_skripsi) {
            Storage::delete($sidang_ta->slip_pembayaran_skripsi);
        }
        if ($sidang_ta->krs) {
            Storage::delete($sidang_ta->krs);
        }

        $sidang_ta->delete();
        return \redirect('sidang-ta')->with('success', 'Data Berhasil Dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $sidangta = SidangTA::findOrFail($id);
        $sidangta->stts_sidang   = $request->stts_sidang;
        $sidangta->update();
        return \redirect('sidang-ta')->with('success', 'Status Sidang Berhasil Diperbarui!');
    }

    public function printFormSidang(Request $request, $id)
    {
        // $kp             = new DaftarKP();
        $sidangta = SidangTA::findOrFail($id);
        $biodata   = Biodata::all();
        $dompdf = new Dompdf();
        // $dompdf->setIsRemoteEnabled(true);

        // Load template view atau HTML yang ingin Anda cetak
        $html = view('tugas-akhir.form-sidang', \compact('sidangta', 'biodata'))->render();

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Set nama file PDF yang akan didownload
        $filename = 'form-seminar.pdf';

        // Mengirimkan file PDF untuk didownload
        return $dompdf->stream($filename, ['Attachment' => false]);
    }
}
