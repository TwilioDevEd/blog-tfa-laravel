<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Otp\Otp;

class OtpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Otp::class, function ($app) {
                return new Otp();
            }
        );
    }
}
