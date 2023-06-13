<?php

namespace App\Http\Controllers;

use App\Models\DaftarKP;
use Illuminate\Http\Request;

class DataKPController extends Controller
{
    public function index()
    {
        $daftarkp = new DaftarKP();

        $data_kp = $daftarkp->data_kp();

        return \view('kerja-praktik.data-kp', \compact('data_kp'));
    }
}
