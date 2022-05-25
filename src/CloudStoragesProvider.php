<?php

namespace App\Providers;

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
            __DIR__.'/../config/storages.php' => config_path('st.php'),
        ]);
    }
}
