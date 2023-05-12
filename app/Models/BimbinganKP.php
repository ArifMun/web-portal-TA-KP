<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganKP extends Model
{
    use HasFactory;
    protected $table = 'bimbingan_kp';
    protected $fillable = [
        'daftarkp_id',
        'dosen_id',
        'mahasiswa_id',
        'judul_bimbingan',
        'laporan_kp',
        'catatan',
        'stts',
        'author'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function daftarkp()
    {
        return $this->belongsTo(DaftarKP::class, 'daftarkp_id');
    }
}
