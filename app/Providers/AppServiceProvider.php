<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\DaftarKP;
use App\Models\FormAkses;
use App\Models\YourModel;
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
        require_once app_path() . '/Helpers/UserCheck.php';
        require_once app_path() . '/Helpers/Notification.php';
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

        // $seminarRegister = Auth::user()->level == 0 &&  Auth::user()->biodata->mahasiswa->bimbingankp->count >= 12 || Auth::user()->level != 0;
        // View::share('seminarRegister', Auth::user()->level == 0 &&  Auth::user()->biodata->mahasiswa->bimbingankp->count >= 12 || Auth::user()->level != 0);
    }
}
