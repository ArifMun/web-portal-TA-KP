<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;
    const JABATAN_OPTIONS = ['kaprodi', 'TU', 'dosen', 'mahasiswa'];
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
        return $this->hasOne(User::class, 'biodata_id');
    }

    public static function getValidationRules()
    {
        return [
            'no_induk' => 'required|no_induk|unique:biodata,no_induk',
            // ...
        ];
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'biodata_id');
    }
    public static function authUser()
    {
        return self::with('users')->whereHas('users', function ($q) {
            $q->where('id', '=', Auth::user());
        });
    }
}
