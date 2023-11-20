<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pengumuman';

    protected $fillable = [
        'cttn_utama',
        'cttn_daftar_kp',
        'cttn_bimbingan_kp',
        'cttn_seminar_kp',
        'cttn_daftar_ta',
        'cttn_bimbingan_ta',
        'cttn_sidang_ta',
    ];
}
