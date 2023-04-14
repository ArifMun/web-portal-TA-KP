<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAkses extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'form_akses';
    protected $fillable = [
        'akses'
    ];
}
