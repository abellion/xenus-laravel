<?php

namespace Xenus\Laravel;

use Illuminate\Support\ServiceProvider;

class XenusServiceProvider extends ServiceProvider
{
    /**
     * The collections to register
     * @var array
     */
    protected $collections = [];

    /**
     * Register all the Xenus services
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(
            new ConnectionServiceProvider($this->app)
        );

        $this->app->register(
            new FailedJobsServiceProvider($this->app)
        );

        $this->app->register(
            new MigrationsServiceProvider($this->app)
        );

        $this->app->register(
            (new CollectionsServiceProvider($this->app))->setCollections($this->collections)
        );
    }
}
