<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

use Xenus\Connection;

use Xenus\Laravel\Models\Migrations as MigrationsModel;
use Xenus\Laravel\Bridge\Migrations as MigrationsRepository;

class MigrationsServiceProvider extends ServiceProvider
{
    /**
     * Register the migrations repository
     *
     * @return void
     */
    public function register()
    {
        $collection = $this->app->config->get('database.migrations', 'migrations');

        $this->app->extend('migration.repository', function () use ($collection) {
            return new MigrationsRepository(
                new MigrationsModel($this->app->make(Connection::class), $collection)
            );
        });
    }
}
