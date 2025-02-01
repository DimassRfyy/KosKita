<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        // Ubah FORCE_HTTPS di env jika uji coba di local menggunakan ngrok ubah ke true jika tidak maka false
        // kode ini digunakan untuk menangani css & asset yang rusak saat uji coba menggunakan ngrok
        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
       }
    }
}
