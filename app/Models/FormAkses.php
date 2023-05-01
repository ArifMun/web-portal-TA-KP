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

    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['toggle_state'] = $value ? true : false;
    // }
}
