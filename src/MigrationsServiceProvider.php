<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

use Xenus\Connection;

use Xenus\Laravel\Bridge\MigrationsRepository;
use Xenus\Laravel\Models\Migrations as MigrationsModel;

class MigrationsServiceProvider extends ServiceProvider
{
    /**
     * The default collection name to store the migrations
     */
    protected const DEFAULT_COLLECTION_NAME = 'migrations';

    /**
     * Register the migrations repository
     *
     * @return void
     */
    public function register()
    {
        $collection = $this->app->config->get('database.migrations', static::DEFAULT_COLLECTION_NAME);

        $this->app->extend('migration.repository', function () use ($collection) {
            return new MigrationsRepository(
                new MigrationsModel($this->app->make(Connection::class), $collection)
            );
        });
    }
}
