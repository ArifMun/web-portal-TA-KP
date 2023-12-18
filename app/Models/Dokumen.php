<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "dokumen";
    protected $fillable = [
        'nama_dokumen',
        'file_dokumen'
    ];
}
