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

        // $formakses = FormAkses::all();
        // $user      = Auth::user();
        // View::share('formakses', $formakses);
    }
}
