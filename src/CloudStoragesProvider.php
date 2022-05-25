<?php

namespace Ully\Cloudstorages;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Ully\Cloudstorages\Services\CredentialsStorage;
use Ully\Cloudstorages\Services\Router;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('access-storage', function (User $user, Storage $storage) {
            return $storage->user->id === $user->id;
        });

        $this->publishes([
            __DIR__ . '/config/storages.php' => config_path('storages.php'),
        ]);

        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerServices();

    }

    protected function registerServices()
    {
        $this->app->when(Router::class)
            ->needs('$drivers')
            ->giveConfig('storages.drivers');
        $this->app->when(CredentialsStorage::class)
            ->needs('$drivers')
            ->giveConfig('storages.driver');

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
}
