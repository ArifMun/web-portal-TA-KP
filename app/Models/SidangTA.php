<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SidangTA extends Model
{
    use HasFactory;

    protected $table = 'sidang_ta';

    protected $fillable = [
        'daftar_ta_id',
        'd_penguji',
        'mahasiswa_id',
        'f_bimbingan_1',
        'f_bimbingan_2',
        'slip_pembayaran',
        // 'catatan',
        'thn_akademik_id',
        'judul',
        'tgl_sidang',
        'jam_sidang',
        'stts_sidang',
        'tempat'
    ];

    // public function mahasiswa()
    // {
    //     return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    // }
    public function thnakademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akademik_id');
    }

    public function daftarta()
    {
        return $this->belongsTo(DaftarTA::class, 'daftar_ta_id');
    }

    public function m_list_sidang()
    {
        return self::with('daftarta')->whereHas('daftarta', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get();
    }

    public function filter()
    {
        return self::distinct()->select('stts_sidang')->get();
    }

    public function s_proses()
    {
        return self::where('stts_sidang', '=', 'proses')->count();
    }

    public function s_terjadwal()
    {
        return self::where('stts_sidang', '=', 'terjadwal')->count();
    }

    public function s_selesai()
    {
        return self::where('stts_sidang', '=', 'selesai')->count();
    }

    public static function registerSidang()
    {
        return self::with('daftarta')->whereHas('daftarta', function ($q) { //cek apakah seminar sudah selesai
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->sortByDesc('id')->count() == 0;
    }
}
