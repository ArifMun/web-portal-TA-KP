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
        return $this->hasMany(DaftarKP::class);
    }

    public function seminarkp()
    {
        return $this->hasMany(SeminarKP::class);
    }
}
