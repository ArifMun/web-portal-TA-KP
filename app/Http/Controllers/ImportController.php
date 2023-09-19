<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Imports\BiodataImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class ImportController extends Controller
{
    public static function index()
    {
        return \view('guest.import');
    }
    public static function import(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'file-import' => 'required',
                'no_induk' => Rule::unique('biodata'),
                'no_telp'  => 'max:12',
                'nama'      => 'required'
                // 'email'    => 'required'
            ],
            [
                // 'email.required' => 'Terdapat Email yang kosong!',
                // 'no_induk.unique'=> 'Terdapat NIM terduplikat!',
                'no_telp.max'    => 'No telpon maksimal 12 digit',
                'nama.required' => 'Terdapat nama yang kosong'
            ]
        );

        if ($validation->fails()) {
            return \redirect('registrasi')->with('warning', 'Data Tidak Tersimpan!')
                ->withInput()
                ->withErrors($validation);
        } else {

            $path = $request->file('file-import')->store('excel');
            Excel::import(new BiodataImport, $path);
            return back()->with('success', 'Excel Data Imported successfully.');
        }
    }
}
