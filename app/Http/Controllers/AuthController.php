<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('forms.login');
    }


    public function login_process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // dd($request->all());
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->level == 0 | 1 | 2 | 3) {
                return redirect()->intended('dashboard')->with('success', 'Anda Berhasil Masuk!');
            }
        } else {

            return \back()->with('warning', 'Username/Password Anda Salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerateToken();
        return \redirect('login-page');
    }
}
