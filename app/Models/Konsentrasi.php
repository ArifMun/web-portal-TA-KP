<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsentrasi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'konsentrasi';

    protected $fillable = [
        'nama_konsentrasi',
    ];

    public function daftarkp()
    {
        return $this->hasMany(DaftarKP::class);
    }
}
