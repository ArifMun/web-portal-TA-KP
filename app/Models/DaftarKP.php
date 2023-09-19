<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\SeminarKP;
use App\Models\BimbinganKP;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarKP extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'daftar_kp';

    protected $fillable = [
        // 'nama',
        // 'nim',
        'mahasiswa_id',
        'd_pembimbing_1',
        'd_pembimbing_2',
        'pembimbing_lama',
        'stts_pengajuan',
        'stts_kp',
        'ganti_pembimbing',
        'semester',
        'slip_pembayaran',
        'thn_akademik_id',
        'konsentrasi',
        'judul'

    ];

    public function tahunakademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akademik_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'd_pembimbing_1');
    }

    public function seminarkp()
    {
        return $this->hasOne(SeminarKP::class, 'daftarkp_id');
    }

    public function bimbingankp()
    {
        return $this->hasMany(BimbinganKP::class, 'daftarkp_id');
    }

    public function d_kp_diterima()
    {
        return self::where('stts_pengajuan', '=', 'diterima')->latest()->get();
    }

    public function data_kp()
    {
        return self::where('stts_pengajuan', '=', 'diterima')->latest()->get();
    }

    public function m_kp_diterima()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->where('stts_pengajuan', '=', 'diterima')->get();
    }

    public function mhskps()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get()->where('stts_pengajuan', '=', 'diterima')->sortByDesc('id')->first();
    }

    public function mhskpd()
    {
        return self::with('dosen')->whereHas('dosen', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('d_pembimbing_1', '=', Auth::user()->biodata->dosen->id);
            }
        })->get()->where('stts_pengajuan', '=', 'diterima')->sortByDesc('id');
    }

    public static function nextkp()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else if (Auth::user()->level != 1) {
                $q->where('id', '=', Auth::user());
            }
        })->get()->sortByDesc('id')->first();
    }

    public static function authDaftarKP()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get()->sortByDesc('id');
    }

    public function SyaratSeminar()
    {
        return self::whereHas('bimbingankp', function ($query) {
            $query->groupBy('daftarkp_id')
                ->havingRaw('COUNT(*) >=2');
        })->whereHas('bimbingankp', function ($query) {
            $query->where('stts', '!=', 'proses');
        })->with('bimbingankp')
            ->get()->sortByDesc('id');
    }
}
