<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'konsentrasi_id',

    ];


    public function tahunakademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akademik_id');
    }

    // public function biodata()
    // {
    //     return $this->hasOne('App\Models\Biodata', 'id');
    // }

    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    // public function dosen()
    // {
    //     return $this->belongsTo(Dosen::class, 'd_pembimbing_1');
    // }

    public function seminarkp()
    {
        return $this->hasOne(SeminarKP::class, 'daftarkp_id');
    }
    // public function konsentrasi()
    // {
    //     return $this->hasOne(Konsentrasi::class, 'id');
    // }

    // public function mahasiswa()
    // {
    //     return $this->hasOne(Mahasiswa::class, 'id');
    // }

    // public function Dosen()
    // {
    //     return $this->hasOne(Dosen::class, 'id');
    // }
}
