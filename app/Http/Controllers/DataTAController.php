<?php

namespace App\Http\Controllers;

use App\Models\DaftarTA;
use Illuminate\Http\Request;

class DataTAController extends Controller
{
    public function index()
    {

        $d_ta = new DaftarTA();
        $d_diterima  = $d_ta->d_diterima();

        return \view('tugas-akhir.data-ta', \compact('d_diterima'));
    }
}
