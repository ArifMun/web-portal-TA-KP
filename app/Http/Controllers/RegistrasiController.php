<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Biodata;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Konsentrasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konsentrasi = Konsentrasi::all();
        $biodata = Biodata::all();
        $users = User::join('biodata', 'biodata.id', '=', 'users.biodata_id')
            ->select('users.*', 'biodata.id', 'biodata.*')
            ->get()
            ->sortByDesc('id');
        $user = User::select('level')
            ->distinct()
            ->get();
        $dosen =
            User::join('biodata', 'biodata.id', '=', 'users.biodata_id')
            ->select('users.*', 'biodata.id', 'biodata.*')
            ->where('jabatan', '=', 'dosen')
            ->get();


        return \view('admin.register', \compact(
            'biodata',
            'user',
            'users',
            'dosen',
            'konsentrasi'
        ));
    }

    public function store(Request $request, Biodata $biodata)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama'          => 'required',
                'email'         => 'required',
                'no_induk'      => 'required|unique:biodata|numeric',
                'jabatan'       => 'required',
                // 'tempat_lahir'  => 'required',
                // 'tgl_lahir'     => 'required',
                'no_telp'       => 'required',
                'password'      => 'required|min:5|max:255',
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \redirect('registrasi')->with('warning', 'Data Tidak Tersimpan !')
                ->withErrors($validation);
        } else {

            $input = $request->input('keahlian');
            $string = \implode(',', $input);
            $biodata = Biodata::create([
                'nama'          => $request->nama,
                'email'         => $request->email,
                'no_induk'      => $request->no_induk,
                'jabatan'       => $request->jabatan,
                'tempat_lahir'  => $request->tempat_lahir,
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telp'       => $request->no_telp,
                'alamat'        => $request->alamat,
                'keahlian'      => $string,
            ]);


            $users = $biodata->users()->create([
                'biodata_id' => $biodata->id,
                'username'   => $biodata->no_induk,
                'password'   => Hash::make($request->password),
                'level'      => $request->level,
            ]);

            if (($request->jabatan == 'dosen') || ($request->jabatan == 'kaprodi')) {
                $biodata->dosen()->create([
                    'biodata_id' => $biodata->id,
                    // 'nama'       => $biodata->nama
                ]);
            } else if ($request->jabatan == 'mahasiswa') {
                $biodata->mahasiswa()->create([
                    'biodata_id' => $biodata->id,
                    // 'nama'       => $biodata->nama
                ]);
            }
            return \redirect('registrasi')->with('success', 'Akun Berhasil Dibuat !');
        }
    }

    public function edit(Biodata $registrasi)
    {
        $biodata = Biodata::findOrFail($registrasi->id);
        $users = User::join('biodata', 'biodata.id', '=', 'users.biodata_id')
            ->select('users.*', 'biodata.id')
            ->get()
            ->sortDesc();
        // $biodatas = Biodata::all();

        return \view('akun.edit-akun', \compact('biodata', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biodata $registrasi)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama'          => 'required',
                'email'         => 'required|email',
                'no_induk'      => 'numeric',
                // 'jabatan'       => 'required',
                // 'tempat_lahir'  => 'required',
                // 'tgl_lahir'     => 'required',
                // 'no_telp'       => 'required',
                'password'      => 'min:5|max:255',
            ]
        );
        // \dd($validation);

        if ($validation->fails()) {
            return \back()->with('warning', 'Data Tidak Tersimpan!');
        } else {

            $biodata = Biodata::findOrFail($registrasi->id);
            $users = User::findOrFail($registrasi->id);

            if ($request->keahlian == null) {
            } else {
                $input = $request->input('keahlian');
                $string = \implode(',', $input);
                $biodata->keahlian      = $string;
            }

            $biodata->nama          = $request->nama;
            $biodata->email         = $request->email;
            $biodata->no_induk      = $request->no_induk;
            $biodata->tempat_lahir  = $request->tempat_lahir;
            $biodata->tgl_lahir     = $request->tgl_lahir;
            $biodata->no_telp       = $request->no_telp;
            $biodata->alamat        = $request->alamat;
            $biodata->jabatan       = $request->jabatan;
            $biodata->update();

            $users->password =
                Hash::make($request->password);
            $users->level = $request->level;
            $users->update();

            return \redirect('registrasi')->with('success', 'Data Berhasil Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biodata = Biodata::find($id);
        // \dd($biodata);
        $biodata->delete();

        return redirect('/registrasi')->with('success', 'Data Berhasil Dihapus');
    }
}
