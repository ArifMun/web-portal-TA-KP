<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\DaftarTA;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BimbinganTA1 extends Model
{
    use HasFactory;

    protected $table = 'bimbing_ta_1';

    protected $fillable = [
        'daftar_ta_id',
        // 'dosen_id',
        // 'mahasiswa_id',
        'judul_bimbingan',
        'laporan_ta',
        'stts',
        'catatan',
        'tgl_bimbingan',
        'author'
    ];

    public function daftarta()
    {
        return $this->belongsTo(DaftarTA::class, 'daftar_ta_id');
    }

    public function b_dosen_1()
    {
        return self::with('daftarta')->whereHas('daftarta', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id);
            }
        })->distinct()->select('daftar_ta_id')->get()->sortByDesc('id');
    }

    public function b_dosen_1_detail()
    {
        return self::with('daftarta')->whereHas('daftarta', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id);
            }
        })->get()->sortByDesc('id');
    }

    public function b_mhs_1()
    {
        return self::with('daftarta')->whereHas('daftarta', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get();
    }
}
