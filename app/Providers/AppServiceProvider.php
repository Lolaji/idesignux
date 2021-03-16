<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        if (!app()->isLocal()){
            URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);

        if (request()->is('backoffice/*')) {
            Inertia::setRootView('admin');
        } else {
            Inertia::setRootView('app');
        }
    }
}
