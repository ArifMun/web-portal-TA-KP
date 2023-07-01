<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public static function index()
    {
        return \view('guest.jadwal-sidang');
    }
}
