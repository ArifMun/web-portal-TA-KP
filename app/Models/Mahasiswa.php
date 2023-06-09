<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'mahasiswa';

    protected $fillable = [
        'biodata_id',
        // 'nama',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }

    public function daftarkp()
    {
        return $this->hasMany(DaftarKP::class, 'mahasiswa_id');
    }

    public function daftarta()
    {
        return $this->hasMany(DaftarTA::class, 'mahasiswa_id');
    }

    // public function seminarkp()
    // {
    //     return $this->hasMany(SeminarKP::class);
    // }

    public function sidangta()
    {
        return $this->hasMany(SidangTA::class, 'mahasiswa_id');
    }

    // public function bimbingankp()
    // {
    //     return $this->hasMany(BimbinganKP::class, 'mahasiswa_id');
    // }

    // public function bimbinganta1()
    // {
    //     return $this->hasMany(BimbinganTA1::class, 'mahasiswa_id');
    // }

    // public function bimbinganta2()
    // {
    //     return $this->hasMany(BimbinganTA2::class, 'mahasiswa_id');
    // }
}
