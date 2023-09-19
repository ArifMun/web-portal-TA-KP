<?php

namespace App\Models;

use PDO;
use App\Models\DaftarKP;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarKP extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'seminar_kp';

    protected $fillable = [
        // 'mahasiswa_id',
        'daftarkp_id',
        'form_bimbingan',
        'tgl_seminar',
        'jam_seminar',
        'stts_seminar',
        'judul',
        'tempat',
        'thn_akademik_id',
        'ket_selesai'
    ];

    public function thnakademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akademik_id');
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
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get();
    }

    public function m_daftar_ta()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) {
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->where('stts_seminar', '=', 'selesai')->get();
    }

    public function daftar_ta()
    {
        return self::where('stts_seminar', '=', 'selesai')->get()->sortByDesc('id');
    }

    public static function registerSeminar()
    {
        return self::with('daftarkp')->whereHas('daftarkp', function ($q) { //cek apakah seminar sudah selesai
            if (Auth::user()->level == 0) {
                $q->where('mahasiswa_id', '=', Auth::user()->biodata->mahasiswa->id);
            }
        })->get()->sortByDesc('id')->count() == 0;
    }

    // public static function SelesaiSeminarKP()
    // {
    //     $tahuns = TahunAkademik::all();
    //     $result = [];

    //     foreach ($tahuns as $tahuna) {
    //         $result[] = $tahuna->tahun;
    //         $jumlahSelesai = SeminarKP::where('stts_seminar', 'selesai')
    //             ->where('thn_akademik_id', $tahuna->id)
    //             ->count();

    //         $result[$tahuna->nama] = $jumlahSelesai;
    //     }
    //     return $result;
    // }
}
