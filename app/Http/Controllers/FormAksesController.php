<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\FormAkses;
use Illuminate\Support\Facades\Validator;

class FormAksesController extends Controller
{

    // public function store(Request $request)
    // {
    //     $validation = Validator::make(
    //         $request->all(),
    //         [
    //             'akses' => 'required|unique:form_akses',
    //         ]
    //     );

    //     if ($validation->fails()) {
    //         return \redirect('manajemen-form')->with('warning', 'Data Tidak Tersimpan !');
    //     } else {

    //         $formakses = FormAkses::create([
    //             'akses' => $request->akses
    //         ]);

    //         return \redirect('manajemen-form')->with('success', 'Akses Form KP Telah Disimpan !');
    //     }
    // }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'tgl_buka' => 'required',
                'tgl_tutup' => 'required',
            ]
        );

        if ($validation->fails()) {
            return \redirect('manajemen-form')->with('warning', 'Tanggal Tidak Tersimpan!');
        } else {
            $formakses = FormAkses::create([
                'tgl_buka' => $request->tgl_buka,
                'tgl_tutup' => $request->tgl_tutup,
            ]);

            return \redirect('manajemen-form')->with('success', 'Tanggal Pendaftaran Kerja Praktik Berhasil Dibuat!');
        }
    }

    public function destroy(FormAkses $formakses, $id)
    {

        $formakses = FormAkses::find($id);
        $formakses->delete();
        return \redirect('manajemen-form')->with('success', 'Akses Berhasil Dihapus!');
    }
}
