<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\FormAkses;
use App\Models\Konsentrasi;
use Carbon\Carbon;

class ManajemenFormController extends Controller
{
    public function index()
    {
        $thnAkademik = TahunAkademik::all()->sortDesc();
        $konsentrasi = Konsentrasi::all()->sortDesc();
        $formAkses   = FormAkses::all()->sortDesc();

        return \view('forms.manajemen-form', \compact('thnAkademik', 'konsentrasi', 'formAkses'));
    }
}
