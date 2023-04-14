<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\FormAkses;
use Illuminate\Support\Facades\Validator;

class FormAksesController extends Controller
{
    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'akses'  => 'required',

            ]
        );

        if ($validation->fails()) {
            return \redirect('manajemen-form')->with('warning', 'Data Tidak Tersimpan !');
        } else {

            $formakses = FormAkses::findOrFail($id);
            $formakses->akses = $request->akses;
            $formakses->update();

            return \redirect('manajemen-form')->with('success', 'Akses Form KP Telah Disimpan !');
        }
    }
}
