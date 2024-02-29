<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Prefecture;
use App\Models\Genre;

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
        view()->composer('shop', function ($view) {
            $prefectures = Prefecture::all();
            $genres = Genre::all();

            $view->with('prefectures', $prefectures);
            $view->with('genres', $genres);
        });
    }
}
