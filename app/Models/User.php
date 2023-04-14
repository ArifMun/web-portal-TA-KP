<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }


    // public function mahasiswa()
    // {
    //     return $this->hasOne(Mahasiswa::class);
    // }
    // public function dosen()
    // {
    //     return $this->hasOne(Dosen::class);
    // }
    // public function tu()
    // {
    //     return $this->hasOne(TU::class);
    // }
}
