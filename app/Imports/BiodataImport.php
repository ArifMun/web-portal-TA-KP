<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Biodata;
use App\Models\Mahasiswa;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BiodataImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function collection(Collection $collection)
    {

        foreach ($collection as $col) {
            $jabatan = $col['jabatan'];
            if (!in_array($jabatan, Biodata::JABATAN_OPTIONS)) {

                continue;
            }
            $biodata = Biodata::create([
                'nama' => $col['nama'],
                'no_induk' => $col['no_induk'],
                'keahlian' => $col['keahlian'],
                'email' => $col['email'],
                'jabatan' => $jabatan,
                'tempat_lahir' => $col['tempat_lahir'],
                'tgl_lahir' => $col['tgl_lahir'],
                'no_telp' => $col['no_telp'],
                'alamat' => $col['alamat'],
            ]);

            $user = new User;
            $user->biodata_id = $biodata->id;
            $user->username = $col['no_induk'];
            $user->password = bcrypt($col['password']);

            if ($col['jabatan'] == 'mahasiswa') {
                $mahasiswa = new Mahasiswa;
                $mahasiswa->biodata_id = $biodata->id;
                $mahasiswa->save();

                $user->level = '0';
                $user->save();
            }
            if ($col['jabatan'] == 'dosen') {
                $mahasiswa = new Dosen;
                $mahasiswa->biodata_id = $biodata->id;
                $mahasiswa->save();

                $user->level = '1';
                $user->save();
            }
            if ($col['jabatan'] == 'kaprodi' || $col['jabatan'] == 'TU') {
                $user->level = '2';
                $user->save();
            }
        }
    }

    public function rules(): array
    {
        return [
            'no_induk' => Rule::unique('biodata'),
            // Definisikan aturan validasi lainnya sesuai kebutuhan Anda
        ];
    }
}
