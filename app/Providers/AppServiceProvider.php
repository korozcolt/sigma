<?php

namespace App\Providers;

use App\Models\Coordinator;
use App\Models\Leader;
use App\Observers\CoordinatorObserver;
use App\Observers\LeaderObserver;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Apply CoordinatorObserver config
        Coordinator::observe(CoordinatorObserver::class);
        Leader::observe(LeaderObserver::class);
    }
}
