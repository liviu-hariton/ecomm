<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $general_settings = Settings::first();

        Config::set('app.timezone', $general_settings->timezone);

        View::composer('*', function($view) use ($general_settings) {
            $view->with('general_settings', $general_settings);
        });
    }
}
