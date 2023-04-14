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
}
