<?php

namespace App\Providers;
require_once app_path('Helpers/CountryHelper.php');
require_once app_path('Helpers/MailerLiteHelper.php');

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
        //
    }
}
