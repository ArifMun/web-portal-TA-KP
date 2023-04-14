<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;
    protected $table = 'biodata';
    protected $fillable = [
        'nama',
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
}
