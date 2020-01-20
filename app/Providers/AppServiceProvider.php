<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Empresa;
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
            $empresa_ = Empresa::find(1);
            View::share('empresa_', $empresa_);
        }
    }
}
