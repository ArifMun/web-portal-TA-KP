<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\FormAkses;
use Illuminate\Support\Facades\Validator;

class FormAksesController extends Controller
{

    public function store(Request $request)
    {

        $existingData = FormAkses::first();
        if ($existingData) {
            return \redirect('pengaturan')->with('warning', 'Hanya Dapat Menampung Satu Data!');
        }

        $validation = Validator::make(
            $request->all(),
            [
                'akses_kp' => 'required',
                'akses_ta' => 'required',
                // 'tgl_tutup' => 'required',
            ]
        );

        if ($validation->fails()) {
            return \redirect('pengaturan')->with('warning', 'Data Tidak Tersimpan!');
        } else {
            $formakses = FormAkses::create([
                'akses_kp' => $request->akses_kp,
                'akses_ta' => $request->akses_ta,
                // 'tgl_tutup' => $request->tgl_tutup,
            ]);

            return \redirect('pengaturan')->with('success', 'Akses Daftar KP Berhasil Di buat');
        }
    }

    public function update_kp(Request $request)
    {
        $formakses = FormAkses::find($request->id);
        $formakses->akses_kp = $request->akses_kp;
        $formakses->save();
        return response()->json(['message' => 'Toggle switch updated successfully.']);
    }

    public function update_ta(Request $request)
    {
        $formakses = FormAkses::find($request->id);
        $formakses->akses_ta = $request->akses_ta;
        $formakses->save();
        return response()->json(['message' => 'Toggle switch updated successfully.']);
    }

    public function destroy(FormAkses $formakses, $id)
    {

        $formakses = FormAkses::find($id);
        $formakses->delete();
        return \redirect('pengaturan')->with('success', 'Akses Berhasil Dihapus!');
    }
}
