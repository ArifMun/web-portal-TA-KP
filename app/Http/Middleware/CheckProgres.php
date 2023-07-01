<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProgres
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::user()->biodata || !Auth::user()->biodata->mahasiswa || Auth::user()->biodata->mahasiswa->daftarkp->count() == 0) {
            return redirect()->back()->with('warning', 'Anda tidak memiliki entri Daftar KP yang terkait.');
            // atau bisa digunakan untuk redirect ke halaman lain yang diinginkan
            // return redirect('/halaman-lain')->with('warning', 'Anda tidak memiliki entri Daftar KP yang terkait.');
        }

        return $next($request);
    }
}
