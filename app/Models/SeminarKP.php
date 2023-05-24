<?php

namespace App\Models;

use PDO;
use App\Models\DaftarKP;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarKP extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'seminar_kp';

    protected $fillable = [
        'mahasiswa_id',
        'daftarkp_id',
        'form_bimbingan',
        'tgl_seminar',
        'jam_seminar',
        'stts_seminar',
        'judul',
        'catatan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function daftarkp()
    {
        return $this->belongsTo(DaftarKP::class, 'daftarkp_id');
    }

    // instansiasi di controller
    public function s_Selesai()
    {
        return self::where('stts_seminar', '=', 'selesai')->count();
    }

    public function s_Terjadwal()
    {
        return self::where('stts_seminar', '=', 'terjadwal')->count();
    }

    public function s_Proses()
    {
        return self::where('stts_seminar', '=', 'proses')->count();
    }

    public function filter()
    {
        return self::distinct()->select('stts_seminar')->get();
    }

    public function m_seminar()
    {
        return self::with('mahasiswa')->whereHas('mahasiswa', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('id', '=', Auth::user()->biodata->mahasiswa->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get();
    }
}
