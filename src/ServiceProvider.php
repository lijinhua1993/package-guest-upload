<?php

namespace Lijinhua\GuestUpload;

use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('guest-upload.php'),
            ]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'guest-upload'
        );

        $this->app->singleton(Upload::class, function ($app) {
            return new Upload();
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [Upload::class];
    }
}