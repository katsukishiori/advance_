<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Prefecture;
use App\Models\Genre;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

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



        // // ここでGateを定義する
        // Gate::define('admin', function ($user) {
        //     return $user->role_id == 10;
        // });

        // Gate::define('shopleader', function ($user) {
        //     return $user->role_id == 20;
        // });
    }
}
