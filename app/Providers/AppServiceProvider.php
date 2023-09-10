<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filters\V1\FoodFilter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FoodFilter::class, function ($app) {
            //pass the current request instance to the FoodFilter constructor
            return new FoodFilter($app['request']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
