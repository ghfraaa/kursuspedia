<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public const HOME = '/';
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        // URL::forceRootUrl(config('app.url')); // tambahkan baris ini
        // if (request()->header('x-forwarded-proto') === 'https') {
        //     URL::forceScheme('https');
        // }
    }
}
