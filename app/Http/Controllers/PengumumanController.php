<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function store(Request $request)
    {
        $existingData = Pengumuman::first();
        if ($existingData) {
            return \redirect('manajemen-form')->with('warning', 'Hanya Dapat Menampung Satu Data!');
        }
        Pengumuman::create([
            'cttn_daftar_kp'    => $request->cttn_daftar_kp,
            'cttn_bimbingan_kp' => $request->cttn_bimbingan_kp,
            'cttn_seminar_kp'   => $request->cttn_seminar_kp,
            'cttn_daftar_ta'    => $request->cttn_daftar_ta,
            'cttn_sidang_ta'    => $request->cttn_sidang_ta,
            'cttn_bimbingan_ta' => $request->cttn_bimbingan_ta,
        ]);

        return \redirect('manajemen-form')->with('success', 'Pengumuman Berhasil Ditambahkan !');
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->cttn_daftar_kp     = $request->cttn_daftar_kp;
        $pengumuman->cttn_bimbingan_kp  = $request->cttn_bimbingan_kp;
        $pengumuman->cttn_seminar_kp    = $request->cttn_seminar_kp;
        $pengumuman->cttn_daftar_ta     = $request->cttn_daftar_ta;
        $pengumuman->cttn_sidang_ta     = $request->cttn_sidang_ta;
        $pengumuman->cttn_bimbingan_ta  = $request->cttn_bimbingan_ta;
        $pengumuman->update();

        return \redirect('manajemen-form')->with('success', 'Pengumuman Berhasil Diperbarui !');
    }

    public function destroy(Pengumuman $pengumuman, $id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

        return \redirect('manajemen-form')->with('success', 'Pengumuman Berhasil Dihapus!');
    }
}
