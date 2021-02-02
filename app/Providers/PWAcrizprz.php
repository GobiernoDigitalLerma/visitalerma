<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class PWAcrizprz extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('PWACRIZPRZ',function(){
            return '<link rel="manifest" href="/manifest.json"><script src="js/registersw.js" charset="utf-8"></script>';

         });
    }
}
