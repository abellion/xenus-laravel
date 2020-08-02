<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

use Xenus\Connection;

class ConnectionServiceProvider extends ServiceProvider
{
    /**
     * Register the Xenus connection
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app->config->get('xenus.connection');

        if ($config === null) {
            return ;
        }

        $this->app->singleton(Connection::class, function () use ($config) {
            return new Connection($config['host'], $config['database'], $config['options'] ?? []);
        });
    }
}
