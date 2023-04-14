<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

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
}
