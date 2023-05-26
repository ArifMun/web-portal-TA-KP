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
        'mahasiswa_id',
        'f_bimbingan_1',
        'f_bimbingan_2',
        'slip_pembayaran',
        'catatan',
        'judul',
        'tgl_sidang',
        'jam_sidang',
        'stts_sidang',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function daftarta()
    {
        return $this->belongsTo(DaftarTA::class, 'daftar_ta_id');
    }

    public function m_list_sidang()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get();
    }

    public function filter()
    {
        return self::distinct()->select('stts_sidang')->get();
    }
}
