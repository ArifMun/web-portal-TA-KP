<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'thn_akademik';
    protected $fillable = [
        'tahun',

    ];

    public function daftarkp()
    {
        return $this->hasMany(DaftarKP::class, 'thn_akademik_id');
    }

    public function seminarkp()
    {
        return $this->hasMany(SeminarKP::class, 'thn_akademik_id');
    }

    public function daftarta()
    {
        return $this->hasMany(DaftarTA::class, 'thn_akademik_id');
    }

    public function sidangta()
    {
        return $this->hasMany(SidangTA::class, 'thn_akademik_id');
    }

    // public static function SelesaiSeminarKP()
    // {
    //     $tahuns = self::all();
    //     $result = [];

    //     foreach ($tahuns as $tahun) {
    //         $jumlahSelesai = SeminarKP::where('stts_seminar', 'selesai')
    //             ->where('thn_akademik_id', $tahun->id)
    //             ->count();

    //         $result[$tahun->nama] = $jumlahSelesai;
    //     }
    //     return $result;
    // }
}