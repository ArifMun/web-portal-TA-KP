<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama_dokumen'  => 'required',
                'file_dokumen'  => 'required',
            ],
            [
                'nama_dokumen.required' => 'Nama tidak boleh kosong',
                'file_dokumen.required' => 'File tidak boleh kosong'
            ]
        );

        if ($validation->fails()) {
            return \redirect('kerja-praktik')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation)
                ->withInput();
        } else {
            Dokumen::create([
                'nama_dokumen'  => $request->nama_dokumen,
                'file_dokumen'  => $request->hasFile('file_dokumen') ? $request->file('file_dokumen')->store('dokumen-panduan') : null
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
                'nama_dokumen'  => 'required',
                // 'file_dokumen'  => 'required',
            ],
            [
                'nama_dokumen.required' => 'Nama tidak boleh kosong',
                // 'file_dokumen.required' => 'File tidak boleh kosong'
            ]
        );

        if ($validation->fails()) {
            return \redirect('pengaturan')->with('warning', 'Data Tidak Tersimpan!')
                ->withErrors($validation)
                ->withInput();
        } else {
            $dokumen = Dokumen::findOrFail($id);
            if ($request->file('file_dokumen')) {
                if ($request->oldFile) {
                    Storage::delete($request->oldFile);
                }
                $dokumen->file_dokumen = $request->file('file_dokumen')->store('dokumen-panduan');
            }

            $dokumen->nama_dokumen = $request->nama_dokumen;
            $dokumen->update();

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
        $dokumen = Dokumen::find($id);
        if ($dokumen->file_dokumen) {
            Storage::delete($dokumen->file_dokumen);
        }
        $dokumen->delete();

        return \back()->with('success', 'Data Berhasil Dihapus!');
    }
}
