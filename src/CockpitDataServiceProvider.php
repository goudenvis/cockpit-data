<?php

namespace Goudenvis\SessionFilter;

use Illuminate\Support\ServiceProvider;

class CockpitDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'config/cockpit-data.php', 'cockpit-data'
        );

        $this->mergeConfigFrom(
            __DIR__.'config/cockpit-data-tables.php', 'cockpit-data-tables'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . 'config/cockpit-data.php' => config_path('cockpit-data.php'),
            __DIR__ . 'config/cockpit-data-tables.php' => config_path('cockpit-data-tables.php'),
        ]);
dd('hoi');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
