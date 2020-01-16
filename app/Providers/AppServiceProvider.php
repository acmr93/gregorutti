<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

use View;

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
        if (php_sapi_name() != 'cli') {
            $empresa = DB::table('empresa')->where('id', 1)->first();
            View::share('empresa', $empresa);
        }
    }
}