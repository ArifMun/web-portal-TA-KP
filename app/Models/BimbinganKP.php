<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganKP extends Model
{
    use HasFactory;
    protected $table = 'bimbingan_kp';
    protected $fillable = [
        'dosen_id',
        'mahasiswa_id',
        'judul_bimbingan',
        'laporan_kp',
        'catatan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
