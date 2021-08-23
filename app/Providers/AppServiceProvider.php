<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Relation::morphMap([
            Config::get('constants.morphs.article') => 'App\Models\Article',
            Config::get('constants.morphs.comment') => 'App\Models\Comment',
        ]);

        Response::macro('success', fn($data) => response()->json([
            'success' => true,
            'data' => $data
        ]));

        Response::macro('error', fn($error, $status_code) => response()->json([
            'success' => false,
            'error' => $error
        ], $status_code));
    }
}
