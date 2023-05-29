<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ThnAkademikController extends Controller
{

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'tahun'  => 'required|unique:thn_akademik',

            ]
        );

        if ($validation->fails()) {
            return \redirect('manajemen-form')->with('warning', 'Data Tidak Tersimpan !');
        } else {
            $thnAkademik = TahunAkademik::create([
                'tahun' => $request->tahun
            ]);
            return \redirect('manajemen-form')->with('success', 'Tahun Berhasil Dibuat !');
        }
    }

    public function destroy(TahunAkademik $thnAkademik, $id)
    {
        $thnAkademik = TahunAkademik::find($id);
        $thnAkademik->delete();

        return redirect('manajemen-form')->with('success', 'Data Berhasil Dihapus');
    }
}
