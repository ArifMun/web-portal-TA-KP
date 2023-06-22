<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BimbinganKP extends Model
{
    use HasFactory;
    protected $table = 'bimbing_kp';
    protected $fillable = [
        'daftarkp_id',
        // 'dosen_id',
        // 'mahasiswa_id',
        'judul_bimbingan',
        'laporan_kp',
        'catatan',
        'stts',
        'author'
    ];

    // public function mahasiswa()
    // {
    //     return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    // }

    // public function dosen()
    // {
    //     return $this->belongsTo(Dosen::class, 'dosen_id');
    // }

    public function daftarkp()
    {
        return $this->belongsTo(DaftarKP::class, 'daftarkp_id');
    }

    public function sttsDosen()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 2) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id)
                    ->where('stts', '=', 'proses');
            }
        })->get()->count();
    }

    public function sttsMhs()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id)
                    ->where('stts', '=', 'proses');
            }
        })->get()->count();
    }

    public function bimbingMhs()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get();
    }

    public function bimbingDosen()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 2) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id);
            } elseif (Auth::user()->level == 3) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id);
            }
        })->get();
    }
}