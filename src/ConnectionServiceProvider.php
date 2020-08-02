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
        $connection = $this->app->config->get('database.mongodb.connection');

        if ($connection === null) {
            return ;
        }

        $this->app->singleton(Connection::class, function () use ($connection) {
            return new Connection($connection['host'], $connection['database'], $connection['options'] ?? []);
        });
    }
}
