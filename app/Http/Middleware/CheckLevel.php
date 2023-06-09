<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return \redirect('login')->with('warning', 'Kamu tidak punya Akses Masuk!!');
        }

        $user = Auth::user();
        if (\in_array($user->level, $roles)) {

            return $next($request);
        } else {
            return \back();
            abort(403);
        }
        // if (Auth::check() && Auth::user()->level == '0') {
        //     return $next($request);
        // }
        // return \back()->with('warning','ANDA TIDAK PUNYA AKSES

    }
}
