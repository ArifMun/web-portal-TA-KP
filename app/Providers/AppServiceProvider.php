<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\DaftarKP;
use App\Models\FormAkses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        $formakses = FormAkses::orderBy('id', 'desc')->first();
        $user      = Auth::user();
        // $akses = ($formakses->tgl_tutup >= now()
        //     && $formakses->tgl_buka <= now());
        // $formakses = FormAkses::orderBy('id', 'desc')->first();
        $daftarkp  = DaftarKP::where('stts_pengajuan', '=', 'tertunda')->get();
        View::share('formakses', $formakses);
        //     View::share('daftarkp', $daftarkp);
        //     View::share('user', $user);
    }
}
