<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Firebase services
        $this->app->singleton(Messaging::class, function ($app) {
            $factory = (new Factory)
                ->withServiceAccount(config('firebase.credentials.file'))
                ->withDatabaseUri(config('firebase.database.url'));

            return $factory->createMessaging();
        });

        // Load migration paths
        $this->loadMigrationsFrom([
            database_path('migrations/events'),
            database_path('migrations/service_providers'),
            database_path('migrations/venues'),
            database_path('migrations/common'),
            database_path('migrations/users'),
            database_path('migrations/actions'),
            database_path('migrations/other'),
            database_path('migrations/payments'),
            database_path('migrations/organizer'),
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
