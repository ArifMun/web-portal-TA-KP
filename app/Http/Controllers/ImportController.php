<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Imports\BiodataImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public static function import(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'file-import' => 'required',
            ]
        );
        
        if ($validation->fails()) {
            return \redirect('registrasi')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation);
        } else {

            $path = $request->file('file-import')->store('excel');
            Excel::import(new BiodataImport, $path);
            return back()->with('success', 'Excel Data Imported successfully.');
        }
    }
}