<?php

namespace App\Containers\Vendor\SocialAuth\Providers;

use Illuminate\Support\ServiceProvider;

class SocialAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Configs/vendor-socialAuth.php' => app_path('Ship/Configs/vendor-socialAuth.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Configs/vendor-socialAuth.php', 'vendor-socialAuth'
        );
    }
}
