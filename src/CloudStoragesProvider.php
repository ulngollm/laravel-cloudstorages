<?php

namespace Ully\Cloudstorages;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        $this->publishes([
            __DIR__ . '/config/storages.php' => config_path('storages.php'),
        ]);
        $this->app->when(Router::class)
            ->needs('$drivers')
            ->giveConfig('storages.driver');

        Gate::define('access-storage', function (User $user, Storage $storage) {
            return $storage->user->id === $user->id;
        });
    }
}
