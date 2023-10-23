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
        $biodata     = Biodata::get()->sortByDesc('id');
        $users       = User::with('biodata')->latest('id')->get();

        $User    = new User();
        $authUser = Auth::user();
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
            'konsentrasi',
            'authUser'
        ));
    }

    public function store(Request $request, Biodata $biodata)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama'          => 'required',
                'email'         => 'required',
                'no_induk'      => 'required|unique:biodata|max:11',
                'jabatan'       => 'required',
                // 'tempat_lahir'  => 'required',
                // 'tgl_lahir'     => 'required',
                'no_telp'       => 'max:12',
                'password'      => 'required|min:5|max:255',
            ],
            [
                'password.required' => 'Password harus lebih dari 5 karakter '
            ]
        );

        // \dd($validation);
        if ($validation->fails()) {
            return \back()->with('warning', 'Data Tidak Tersimpan !')
                ->withInput()
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
                'alamat_kec'    => $request->alamat_kec,
                'alamat_kab'    => $request->alamat_kab,
                'keahlian'      => $string,
                'nama_ayah'     => $request->nama_ayah,
                'nama_ibu'      => $request->nama_ibu,
                'alamat_ortu'   => $request->alamat_ortu,
                'pekerjaan_ortu' => $request->pekerjaan_ortu,
                'no_hp_ortu'    => $request->no_hp_ortu
            ]);


            $users = $biodata->users()->create([
                'biodata_id' => $biodata->id,
                'username'   => $biodata->no_induk,
                'password'   => Hash::make($request->password),
                'level'      => $request->level,
            ]);

            if (($request->jabatan == 'dosen')) {
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

    public function update(Request $request, Biodata $registrasi)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nama'          => 'required',
                'email'         => 'email',
                'no_induk'      => 'required|max:11',
                // 'jabatan'       => 'required',
                // 'tempat_lahir'  => 'required',
                // 'tgl_lahir'     => 'required',
                'no_telp'       => 'max:12',
                'password'      => 'min:5|max:255',
            ]
        );
        // dd($validation);

        if ($validation->fails()) {
            return \back()->with('warning', 'Data Tidak Tersimpan!')
                ->withInput()
                ->withErrors($validation);
        } else {

            $biodata = Biodata::findOrFail($registrasi->id);
            // $users = User::findOrFail($registrasi->id);

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

            $biodata->users->password =
                Hash::make($request->password);
            $biodata->users->level = $request->level;
            $biodata->users->update();

            return \redirect('/registrasi')->with('success', 'Data Berhasil Diubah');
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

        return \back()->with('success', 'Data Berhasil Dihapus');
    }
}
