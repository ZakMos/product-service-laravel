<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        // Schema::defaultStringLength(191);
        Validator::extend('productQuality', function($attribute, $value, $parameters) {
            return !perg_match('/[^A-Za-z]/', $value)
            && preg_match('/eetsJeats|uitesJets|ites|ettes$/', $value);
        });
    }
}
