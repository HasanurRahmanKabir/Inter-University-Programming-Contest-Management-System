<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // এই লাইনটি অতিরিক্ত যোগ করা হয়েছে

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
        // রেলওয়ে বা প্রোডাকশন সার্ভারে থাকলে সব লিঙ্ক HTTPS এ ফোর্স করবে
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}