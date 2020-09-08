<?php

namespace Goudenvis\CockpitData;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Goudenvis\CockpitData\Commands\CockpitDataFetchCommand;
use Illuminate\Support\Str;

class CockpitDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {

            foreach (self::migrationFileNames() as $migrationFileName) {
                $this->runMigration($migrationFileName);
            }

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->publishes([
                __DIR__ . '/../config/cockpit-data.php' => config_path('cockpit-data.php'),
                __DIR__ . '/../config/cockpit-data-tables.php' => config_path('cockpit-data-tables.php'),
            ]);

            $this->commands([
                CockpitDataFetchCommand::class
            ]);
        }
    }

    private static function migrationFileNames()
    {
        return collect(File::files(__DIR__.'/../database/migrations'))->map(function ($file) {
            $name = $file->getFileName();

            return Str::before($name, '.stub');
        })->toArray();
    }

    public function runMigration($migrationFileName)
    {
        if (! $this->migrationFileExists($migrationFileName)) {
            $this->publishes([
                __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
            ], 'migrations');
        }
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
