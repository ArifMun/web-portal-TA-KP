<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'biodata';
    protected $fillable = [
        'nama',
        'email',
        'no_induk',
        'keahlian',
        'jabatan',
        'tempat_lahir',
        'tgl_lahir',
        'no_telp',
        'alamat'
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    // public function daftarKP()
    // {
    //     return $this->belongsTo('App\Models\DaftarKP', 'biodata_id');
    // }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'biodata_id');
    }
}
