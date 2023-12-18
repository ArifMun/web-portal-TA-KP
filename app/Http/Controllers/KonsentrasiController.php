<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Konsentrasi;
use Illuminate\Support\Facades\Validator;

class KonsentrasiController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama_konsentrasi'  => 'required',

            ]
        );

        if ($validation->fails()) {
            return \redirect('pengaturan')->with('warning', 'Konsentrasi Tidak Tersimpan!');
        } else {
            $thnAkademik = Konsentrasi::create([
                'nama_konsentrasi' => $request->nama_konsentrasi
            ]);
            return \redirect('pengaturan')->with('success', 'Konsentrasi Berhasil Dibuat!');
        }
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama_konsentrasi' => 'required',
            ]
        );

        if ($validation->fails()) {
            return \redirect('pengaturan')->with('warning', 'Konsentrasi Tidak Tersimpan!');
        } else {
            $konsentrasi = Konsentrasi::findOrFail($id);
            $konsentrasi->nama_konsentrasi = $request->nama_konsentrasi;
            $konsentrasi->update();

            return \redirect('pengaturan')->with('success', 'Konsentrasi Berhasil Diperbarui!');
        }
    }

    public function destroy($id)
    {
        $konsentrasi = Konsentrasi::find($id);
        $konsentrasi->delete();

        return redirect('pengaturan')->with('success', 'Konsentrasi Berhasil Dihapus');
    }
}
