<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\DaftarTA;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BimbinganTA1 extends Model
{
    use HasFactory;

    protected $table = 'bimbing_ta_1';

    protected $fillable = [
        'daftar_ta_id',
        'dosen_id',
        'mahasiswa_id',
        'judul_bimbingan',
        'laporan_ta',
        'stts',
        'catatan'
    ];

    public function daftarta()
    {
        return $this->belongsTo(DaftarTA::class, 'daftar_ta_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
        // ->Where('d_pembimbing_2', '=', 'd_pembimbing_2');
    }
    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'd_pembimbing_2');
        // ->Where('d_pembimbing_2', '=', 'd_pembimbing_2');
    }

    public function b_dosen_1()
    {
        return self::with('dosen1')->whereHas('dosen1', function ($q) {
            if (Auth::user()->level == 1) {
                $q->where('id', '=', Auth::user()->biodata->dosen->id);
            } else {
                $q->where('id', '=', Auth::user());
            }
        })->get();
    }
}