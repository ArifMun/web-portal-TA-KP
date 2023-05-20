<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTA extends Model
{
    use HasFactory;
    protected $table = 'daftar_ta';
    protected $fillable = [
        'mahasiswa_id',
        'd_pembimbing_1',
        'd_pembimbing_2',
        'judul',
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
}
