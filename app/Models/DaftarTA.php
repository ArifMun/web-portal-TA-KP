<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarTA extends Model
{
    use HasFactory;
    protected $table = 'daftar_ta';
    protected $fillable = [
        'mahasiswa_id',
        'd_pembimbing_1',
        'd_pembimbing_2',
        'judul',
        'ganti_pembimbing',
        'pembimbing_lama_1',
        'pembimbing_lama_2',
        'stts_pengajuan',
        'stts_ta',
        'krs',
        'thn_akademik_id',
        'konsentrasi'
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
        return $this->belongsTo(Dosen::class, 'd_pembimbing_1', 'd_pembimbing_2');
    }

    public function sidangta()
    {
        return $this->hasOne(SidangTA::class, 'daftar_ta_id');
    }

    // 
    public function filter()
    {
        return self::distinct()->select('stts_pengajuan')->get();
    }

    public function d_diterima()
    {
        return self::where('stts_pengajuan', '=', 'diterima')->get()->count();
    }

    public function d_tertunda()
    {
        return self::where('stts_pengajuan', '=', 'tertunda')->get()->count();
    }

    public function d_ditolak()
    {
        return self::where('stts_pengajuan', '=', 'ditolak')->get()->count();
    }

    public function m_list_ta()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get();
    }

    public function m_ta_diterima()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->where('stts_pengajuan', '=', 'diterima')->get();
    }
}
