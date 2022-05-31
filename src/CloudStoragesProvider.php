<?php

namespace Ully\Cloudstorages;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ully\Cloudstorages\Commands\UpdateDrivers;
use Ully\Cloudstorages\Services\CredentialsStorage;
use Ully\Cloudstorages\Services\Router;
use Ully\Cloudstorages\View\Components\File;
use Ully\Cloudstorages\View\Components\Storage;

class CloudStoragesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerServices();
        $this->registerGate();
        $this->registerView();
        $this->registerCommands();

    }

    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/config/storages.php' => config_path('storages.php'),
        ]);
    }

    protected function registerGate()
    {
        Gate::define('access-storage', function (User $user, Storage $storage) {
            return $storage->user->id === $user->id;
        });
    }

    protected function registerServices()
    {
        $this->app->when(Router::class)
            ->needs('$drivers')
            ->giveConfig('storages.drivers');
        $this->app->when(CredentialsStorage::class)
            ->needs('$drivers')
            ->giveConfig('storages.drivers');

    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'storages-migrations');
        $this->publishes([
            __DIR__ . '/database/seeders/StorageTypeSeeder.php' => database_path('seeders'),
        ], 'storages-seeds');
    }

    protected function registerRoutes()
    {
        Route::middleware('api')
            ->prefix(config('storages.config.routes.prefix'))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
            });
    }

    public function registerView()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'cloudstorages');
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/cloudstorages'),
        ]);
        Blade::component('cloud-file', File::class);
        Blade::component('cloud-storage', Storage::class);
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateDrivers::class,
            ]);
        }
    }
}
