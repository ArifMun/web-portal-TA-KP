<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'dosen';

    protected $fillable = [
        'biodata_id',
        // 'nama',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    public function daftarkp()
    {
        return $this->hasMany(DaftarKP::class, 'd_pembimbing_1');
    }

    // 
    public function daftarta1()
    {
        return $this->hasMany(DaftarTA::class);
        // ->Where('d_pembimbing_2', '=', 'd_pembimbing_2');
    }
    public function daftarta2()
    {
        return $this->hasMany(DaftarTA::class, 'd_pembimbing_2');
        // ->Where('d_pembimbing_2', '=', 'd_pembimbing_2');
    }
    // 

    public function bimbingankp()
    {
        return $this->hasMany(BimbinganKP::class, 'dosen_id');
    }

    public function bimbinganta1()
    {
        return $this->hasMany(BimbinganTA1::class, 'd_pembimbing_1');
    }
}
